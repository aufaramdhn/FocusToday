<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with(['category', 'author'])->latest()->paginate(10);
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'status'      => 'required|in:draft,published,archived',
        ]);

        $article = Article::create([
            'user_id'     => Auth::id(),
            'category_id' => $request->category_id,
            'title'       => $request->title,
            'slug'        => Str::slug($request->title) . '-' . Str::random(5),
            'status'      => $request->status,
            'views'       => 0,
            'published_at'=> $request->status == 'published' ? now() : null,
        ]);

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil dibuat!');
    }

    public function edit(Article $article)
    {
        $categories = Category::all();
        return view('admin.articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'status'      => 'required|in:draft,published,archived',
        ]);

        $newSlug = Str::slug($request->title);
        
        $publishedAt = $article->published_at;
        if ($request->status == 'published' && $article->status != 'published') {
            $publishedAt = now();
        } elseif ($request->status == 'draft') {
            $publishedAt = null;
        }

        $article->update([
            'category_id' => $request->category_id,
            'title'       => $request->title,
            'slug'        => $newSlug != $article->slug ? $newSlug . '-' . Str::random(5) : $article->slug,
            'status'      => $request->status,
            'published_at'=> $publishedAt,
        ]);

        return redirect()->route('articles.index')->with('success', 'Artikel diperbarui!');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return back()->with('success', 'Artikel dihapus.');
    }
}
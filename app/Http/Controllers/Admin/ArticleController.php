<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $status = request('status', 'all');

        $query = Article::with(['category', 'author'])->latest();

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $articles = $query
            ->filter($request->all())
            ->paginate(9)
            ->withQueryString();

        $tags = Tag::all();

        $articles_blocks = Article::with('blocks')->get();

        $categories = Category::all();

        return view('admin.artikel.index', compact('articles', 'status', 'tags', 'articles_blocks', 'categories'));
    }

    public function show(Article $article)
    {
        $article->load(['category', 'author', 'blocks', 'tags', 'comments'])
            ->where('id', $article->id)
            ->firstOrFail();
        return view('admin.artikel.detail-artikel', compact('article'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.artikel.tambah-artikel', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'             => 'required|string|max:255',
            'category_id'       => 'required|exists:categories,id',
            'thumbnail'         => 'nullable|image',
            'tags'              => 'nullable|array',
            'tags.*'            => 'exists:tags,id',
            'blocks'            => 'required|array',
            'blocks.*.type'     => 'required|string',
            'blocks.*.content'  => 'nullable|string',
            'blocks.*.image'    => 'nullable|image',
        ], [
            'title.required' => 'Judul artikel wajib diisi.',
            'blocks.required' => 'Artikel harus memiliki konten.',
        ]);

        DB::transaction(function () use ($request) {
            $thumbnailPath = null;

            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
            }

            $article = Article::create([
                'user_id'      => 1,
                'category_id'  => $request->category_id,
                'title'        => $request->title,
                'slug'         => Str::slug($request->title) . '-' . Str::random(5),
                'thumbnail'    => $thumbnailPath,
                'views'        => 0,
                'published_at' => now(),
            ]);

            if ($request->has('tags')) {
                $article->tags()->sync($request->tags);
            }

            foreach ($request->blocks as $index => $blockData) {
                $mediaPath = null;

                if ($request->hasFile("blocks.$index.image")) {
                    $mediaPath = $request->file("blocks.$index.image")->store('article-media', 'public');
                }

                $article->blocks()->create([
                    'type'       => $blockData['type'],
                    'content'    => $blockData['content'] ?? null,
                    'media_path' => $mediaPath,
                    'position'   => $index + 1,
                ]);
            }
        });

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil dibuat!');
    }

    public function edit(Article $article)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.artikel.edit-artikel', compact('article', 'categories', 'tags'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title'                 => 'required|string|max:255',
            'category_id'           => 'required|exists:categories,id',
            'status'                => 'required|in:published,archived,draft',
            'thumbnail'             => 'nullable|image|max:2048',
            'tags'                  => 'nullable|array',
            'tags.*'                => 'exists:tags,id',
            'blocks'                => 'required|array',
            'blocks.*.type'         => 'required|string',
            'blocks.*.content'      => 'nullable|string',
            'blocks.*.image'        => 'nullable|image|max:2048',
            'blocks.*.existing_media_path' => 'nullable|string',
        ], [
            'title.required' => 'Judul artikel wajib diisi.',
            'blocks.required' => 'Artikel harus memiliki konten.',
        ]);

        DB::transaction(function () use ($request, $article) {
            $thumbnailPath = $article->thumbnail;

            if ($request->hasFile('thumbnail')) {
                if ($article->thumbnail && Storage::disk('public')->exists($article->thumbnail)) {
                    Storage::disk('public')->delete($article->thumbnail);
                }
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
            }

            $newSlug = Str::slug($request->title);
            $publishedAt = $article->published_at;

            if ($request->status == 'published' && $article->status != 'published') {
                $publishedAt = now();
            } elseif ($request->status == 'draft') {
                $publishedAt = null;
            }

            $article->update([
                'category_id'  => $request->category_id,
                'user_id'      =>  1,
                'title'        => $request->title,
                'slug'         => $newSlug != $article->slug ? $newSlug . '-' . Str::random(5) : $article->slug,
                'thumbnail'    => $thumbnailPath,
                'status'       => $request->status,
                'published_at' => $publishedAt,
            ]);

            if ($request->has('tags')) {
                $article->tags()->sync($request->tags);
            } else {
                $article->tags()->detach();
            }

            $article->blocks()->delete();

            foreach ($request->blocks as $index => $blockData) {
                $mediaPath = null;

                if ($request->hasFile("blocks.$index.image")) {
                    $mediaPath = $request->file("blocks.$index.image")->store('article-media', 'public');
                } elseif (isset($blockData['existing_media_path'])) {
                    $mediaPath = $blockData['existing_media_path'];
                }

                $article->blocks()->create([
                    'type'       => $blockData['type'],
                    'content'    => $blockData['content'] ?? null,
                    'media_path' => $mediaPath,
                    'position'   => $index + 1,
                ]);
            }
        });

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy(Article $article)
    {
        if ($article->thumbnail && Storage::disk('public')->exists($article->thumbnail)) {
            Storage::disk('public')->delete($article->thumbnail);
        }

        foreach ($article->blocks as $block) {
            if ($block->type === 'image' && $block->media_path) {
                if (Storage::disk('public')->exists($block->media_path)) {
                    Storage::disk('public')->delete($block->media_path);
                }
            }
        }

        $article->delete();

        return back()->with('success', 'Artikel dan seluruh aset gambar berhasil dihapus.');
    }

    public function archive(Article $article)
    {
        $article->update([
            'status' => 'archived'
        ]);

        return back()->with('success', 'Artikel berhasil diarsipkan.');
    }

    public function restore(Article $article)
    {
        $article->update([
            'status' => 'published',
            'published_at' => now(),
        ]);

        return back()->with('success', 'Artikel kembali dipublish.');
    }
}

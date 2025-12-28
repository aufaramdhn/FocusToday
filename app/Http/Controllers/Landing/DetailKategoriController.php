<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Article;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DetailKategoriController extends Controller
{
    public function show(Category $category)
    {
        $articles = $category->articles()
            ->published()
            ->latest('published_at')
            ->get();
            
        return $this->sendToView($category, $articles);
    }

    public function terbaru()
    {
        $threeDaysAgo = Carbon::now()->subDays(3);

        $articles = Article::published()
            ->where('published_at', '>=', $threeDaysAgo)
            ->latest('published_at')
            ->get();

        $category = new Category();
        $category->name = 'Berita Terbaru (3 Hari Terakhir)';
        $category->slug = 'terbaru';

        return $this->sendToView($category, $articles);
    }

    private function sendToView($category, $articles)
    {
        $heroArticle  = $articles->first();
        $gridArticles = $articles->skip(1)->take(2);
        $listArticles = $articles->skip(3);

        return view('pages.detail-kategori', compact(
            'category', 
            'heroArticle', 
            'gridArticles', 
            'listArticles'
        ));
    }
}
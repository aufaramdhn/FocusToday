<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        $heroArticle = Article::with('category')
            ->published()
            ->latest('published_at')
            ->first();

        $popularArticles = Article::with('category')
            ->published()
            ->where('id', '!=', $heroArticle?->id)
            ->orderByDesc('views')
            ->take(5)
            ->get();

        $latestArticles = Article::with('category')
            ->published()
            ->where('id', '!=', $heroArticle?->id)
            ->latest('published_at')
            ->take(5)
            ->get();

        $bottomCategories = Category::whereHas('articles', function ($query) {
                $query->published();
            }, '>=', 1) 
            ->with(['articles' => function ($query) {
                $query->published()
                      ->latest('published_at')
                      ->take(5); 
            }])
            ->inRandomOrder() 
            ->take(4)
            ->get();
        
        $sidebarCategories = Category::whereHas('articles', function ($query) {
                $query->published();
            }, '>=', 1)
            ->with(['articles' => function ($query) {
                $query->published()->latest('published_at')->take(1); 
            }])
            ->inRandomOrder()
            ->take(4)         
            ->get();


        $youtubeVideos = Cache::remember('youtube_feed', 3600, function () {
            $apiKey = env('YOUTUBE_API_KEY');
            $channelId = env('YOUTUBE_CHANNEL_ID');

            $response = Http::get("https://www.googleapis.com/youtube/v3/search", [
                'part' => 'snippet',
                'channelId' => $channelId,
                'maxResults' => 5,
                'order' => 'date',
                'type' => 'video',
                'key' => $apiKey
            ]);

            if ($response->successful()) {
                return $response->json()['items'];
            }

            return [];
        });

        $mainVideo = $youtubeVideos[0] ?? null;

        $sideVideos = !empty($youtubeVideos) ? array_slice($youtubeVideos, 1, 4) : [];

        return view('pages.home', compact(
            'heroArticle',
            'latestArticles',
            'mainVideo',
            'sideVideos',
            'popularArticles',
            'bottomCategories',
            'sidebarCategories'
        ));
    }

    private function getArticlesByCategory($slug)
    {
        return Article::whereHas('category', function ($q) use ($slug) {
            $q->where('slug', $slug);
        })
            ->published()
            ->latest('published_at')
            ->take(5)
            ->get();
    }

    public function show(Article $article)
    {
        $article->increment('views');
        return view('pages.detail-artikel', compact('article'));
    }

}

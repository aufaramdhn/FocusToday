<?php

namespace App\Http\Controllers\Landing;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

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
        }, '>=', 4)
            ->with(['articles' => function ($query) {
                $query->published()
                    ->latest('published_at')
                    ->take(4);
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


        $youtubeVideos = Cache::remember('youtube_feed_mixed_home', 3600, function () {
            $apiKey = env('YOUTUBE_API_KEY');
            $channels = [
                env('YOUTUBE_CHANNEL_MALAKA'),
                env('YOUTUBE_CHANNEL_NARASI'),
            ];

            $allVideos = collect();

            foreach ($channels as $channelId) {
                if (!$channelId) continue;

                $response = Http::get("https://www.googleapis.com/youtube/v3/search", [
                    'part' => 'snippet',
                    'channelId' => $channelId,
                    'maxResults' => 5,
                    'order' => 'date',
                    'type' => 'video',
                    'key' => $apiKey
                ]);

                if ($response->successful()) {
                    $allVideos = $allVideos->merge($response->json()['items']);
                }
            }

            return $allVideos->sortByDesc(function ($video) {
                return $video['snippet']['publishedAt'];
            })->values()->take(10)->all();
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

    public function show(Article $article)
    {
        $article->increment('views');

        $recommendations = Article::where('id', '!=', $article->id)
            ->where('status', 'published')
            ->inRandomOrder()
            ->limit(4)
            ->get();

        $related_articles = Article::where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->where('status', 'published')
            ->latest()
            ->limit(4)
            ->get();

        if ($related_articles->count() < 1) {
            $related_articles = Article::where('id', '!=', $article->id)
                ->where('status', 'published')
                ->latest()
                ->limit(4)
                ->get();
        }

        $comments = Comment::where('article_id', $article->id)
            ->where('status', 'approved')
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.detail-artikel', compact(
            'article',
            'recommendations',
            'related_articles',
            'comments'
        ));
    }

    public function search(Request $request)
    {
        $keyword = $request->search;

        if (!$keyword) {
            return redirect()->route('home');
        }

        $articles = Article::where('status', 'published')
            ->where(function ($query) use ($keyword) {
                $query->where('title', 'like', "%{$keyword}%")
                    ->orWhere('content', 'like', "%{$keyword}%")
                    ->orWhereHas('category', function ($q) use ($keyword) {
                        $q->where('name', 'like', "%{$keyword}%");
                    })
                    ->orWhereHas('tags', function ($q) use ($keyword) {
                        $q->where('name', 'like', "%{$keyword}%");
                    });
            })
            ->with(['category', 'author'])
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('pages.search-result', compact('articles', 'keyword'));
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
}

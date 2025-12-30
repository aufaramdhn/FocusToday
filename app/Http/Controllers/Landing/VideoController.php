<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class VideoController extends Controller
{
    public function show($videoId)
    {
        $apiKey = env('YOUTUBE_API_KEY');

        $currentVideo = Cache::remember('video_' . $videoId, 3600, function () use ($apiKey, $videoId) {
            $response = Http::get("https://www.googleapis.com/youtube/v3/videos", [
                'part' => 'snippet,statistics',
                'id' => $videoId,
                'key' => $apiKey
            ]);

            return $response->json()['items'][0] ?? null;
        });

        if (!$currentVideo) {
            return redirect('/');
        }

        $youtubeVideos = Cache::remember('youtube_feed_mixed_detail', 3600, function () use ($apiKey) {
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
                    'maxResults' => 10,
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
            })->values()->take(20)->all();
        });

        $relatedVideos = collect($youtubeVideos)->filter(function ($video) use ($videoId) {
            return data_get($video, 'id.videoId') !== $videoId;
        });

        return view('pages.detail-watch', compact('currentVideo', 'relatedVideos'));
    }
}

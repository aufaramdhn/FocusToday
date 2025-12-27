<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $articleCount = Article::count();
        if ($articleCount == 0) {
            $this->command->error('Artikel kosong! Jalankan ArticleSeeder dulu.');
            return;
        }

        $this->command->info('Membuat 3 komentar untuk setiap artikel...');

        $articles = Article::all();

        foreach ($articles as $article) {
            Comment::factory(3)->make([])->each(function ($comment) use ($article) {
                $publishedDate = Carbon::parse($article->published_at);
                $comment->created_at = $publishedDate->copy()->addHours(rand(1, 48));
                $comment->updated_at = $comment->created_at;

                $comment->save();
            });
        }

        $this->command->info('Selesai! Total komentar sekarang: ' . Comment::count());
    }
}

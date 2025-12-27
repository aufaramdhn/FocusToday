<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\User;
use App\Models\Article;
use App\Models\Category;
use App\Models\ArticleBlock;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $userIds = User::pluck('id');
        $categoryIds = Category::pluck('id');
        $tagIds = Tag::pluck('id');

        if ($userIds->isEmpty() || $categoryIds->isEmpty()) {
            $this->command->error('User atau Category kosong! Jalankan UserSeeder & CategorySeeder dulu.');
            return;
        }

        $this->command->info('Sedang membuat 80 artikel dengan gambar random...');

        Article::factory(80)
            ->make()
            ->each(function ($article) use ($userIds, $categoryIds, $tagIds) {
                $article->user_id = $userIds->random(10)->first();
                $article->category_id = $categoryIds->random();
                $randomNum = rand(1, 10000);
                $article->thumbnail = "https://loremflickr.com/800/400/technology,business,city?random={$randomNum}";
                $article->save();
                ArticleBlock::create([
                    'article_id' => $article->id,
                    'type' => 'text',
                    'content' => fake()->paragraph(rand(5, 10)),
                    'position' => 1,
                ]);
                $randomNum2 = rand(1, 10000);
                ArticleBlock::create([
                    'article_id' => $article->id,
                    'type' => 'image',
                    'media_path' => "https://loremflickr.com/600/400/computer,work?random={$randomNum2}",
                    'position' => 2,
                ]);
                ArticleBlock::create([
                    'article_id' => $article->id,
                    'type' => 'text',
                    'content' => fake()->paragraph(rand(4, 8)),
                    'position' => 3,
                ]);
                if ($tagIds->isNotEmpty()) {
                    $article->tags()->attach($tagIds->random(rand(2, 5)));
                }
            });

        $this->command->info('Selesai! 80 Artikel berhasil dibuat.');
    }
}

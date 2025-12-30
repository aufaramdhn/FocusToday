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
            $this->command->error('❌ User atau Category kosong! Jalankan UserSeeder & CategorySeeder dulu.');
            return;
        }

        $this->command->info('🚀 Membuat 80 artikel dengan struktur konten yang rapi...');

        Article::factory(80)->make()->each(function ($article) use ($userIds, $categoryIds, $tagIds) {

            $article->user_id = $userIds->random();
            $article->category_id = $categoryIds->random();

            $rand = rand(1, 99999);
            $article->thumbnail = "https://picsum.photos/seed/{$rand}/800/400";

            $article->save();

            ArticleBlock::create([
                'article_id' => $article->id,
                'type' => 'text',
                'content' => fake()->realText(500),
                'position' => 1,
            ]);

            $randImg = rand(1, 99999);
            ArticleBlock::create([
                'article_id' => $article->id,
                'type' => 'image',
                'media_path' => "https://picsum.photos/seed/{$randImg}/600/400",
                'position' => 2,
            ]);

            ArticleBlock::create([
                'article_id' => $article->id,
                'type' => 'text',
                'content' => fake()->realText(300),
                'position' => 3,
            ]);

            if ($tagIds->isNotEmpty()) {
                $article->tags()->attach($tagIds->random(rand(2, 4)));
            }
        });

        $this->command->info('✅ Selesai! 80 Artikel dengan konten real berhasil dibuat.');
    }
}

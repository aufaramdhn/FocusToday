<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $author = User::first();
        $category = Category::first();

        if (!$author || !$category) {
            return;
        }

        for ($i = 1; $i <= 6; $i++) {
            Article::create([
                'user_id' => $author->id,
                'category_id' => $category->id,
                'title' => "Published Article {$i}",
                'slug' => Str::slug("Published Article {$i}"),
                'status' => 'published',
                'published_at' => now(),
                'views' => rand(10, 200),
            ]);
        }

        for ($i = 1; $i <= 6; $i++) {
            Article::create([
                'user_id' => $author->id,
                'category_id' => $category->id,
                'title' => "Archived Article {$i}",
                'slug' => Str::slug("Archived Article {$i}"),
                'status' => 'archived',
                'published_at' => null,
                'views' => rand(0, 50),
            ]);
        }
    }
}

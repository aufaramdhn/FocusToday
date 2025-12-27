<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->unique()->sentence(rand(4, 8));

        return [
            'user_id' => 1,
            'category_id' => 1,
            'title' => $title,
            'slug' => Str::slug($title),
            'thumbnail' => 'https://placehold.co/800x400?text=News+Thumbnail',
            'status' => fake()->randomElement(['published', 'draft']),
            'views' => fake()->numberBetween(10, 5000),
            'published_at' => fake()->dateTimeBetween('-1 year', 'now'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

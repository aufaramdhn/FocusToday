<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => rand(1, 6),
            'article_id' => rand(1, 80),
            'content' => fake()->sentence(rand(6, 15)),
            'status' => 'approved',
            'created_at' => fake()->dateTimeBetween('-3 months', 'now'),
        ];
    }
}

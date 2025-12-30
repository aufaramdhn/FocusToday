<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ArticleBlock>
 */
class ArticleBlockFactory extends Factory
{
    public function definition(): array
    {
        return [
            'article_id' => Article::factory(),
            'type' => 'text',
            'content' => fake()->paragraph(rand(3, 5)),
            'media_path' => null,
            'position' => 1,
        ];
    }

    public function imageType(): static
    {
        return $this->state(fn(array $attributes) => [
            'type' => 'image',
            'content' => null,
            'media_path' => 'https://placehold.co/600x400/png?text=Content+Image',
        ]);
    }
}

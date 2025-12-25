<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            'AI',
            'Blockchain',
            'Climate Change',
            'Elections',
            'Olympics',
            'Stock Market',
            'Movies',
            'Music',
            'Online Learning',
            'Scholarships',
        ];

        foreach ($tags as $name) {
            Tag::firstOrCreate(
                ['name' => $name],
                ['slug' => Str::slug($name)]
            );
        }
    }
}

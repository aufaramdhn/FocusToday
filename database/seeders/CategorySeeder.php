<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Teknologi',
            'Bisnis & Keuangan',
            'Kesehatan',
            'Gaya Hidup',
            'Kuliner',
            'Travel',
            'Otomotif',
            'Politik',
            'Olahraga',
            'Hiburan',
            'Sains',
            'Edukasi',
            'Fashion',
            'Kecantikan',
            'Properti',
            'Gaming',
            'Parenting',
            'Hukum & Kriminal',
            'Opini',
            'Internasional'
        ];

        foreach ($categories as $name) {
            Category::firstOrCreate(
                ['name' => $name],
                ['slug' => Str::slug($name)]
            );
        }
    }
}

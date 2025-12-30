<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            'Artificial Intelligence',
            'Machine Learning',
            'Blockchain',
            'Cryptocurrency',
            'Startup',
            'Cybersecurity',
            'Coding',
            'Gadget Review',
            'Saham',
            'Investasi',
            'UMKM',
            'Ekonomi Digital',
            'Resesi Global',
            'Mental Health',
            'Diet Sehat',
            'Yoga',
            'Tips Produktivitas',
            'Work Life Balance',
            'Viral',
            'Breaking News',
            'Tutorial',
            'Tips & Trick',
            'Review Jujur',
            'Rekomendasi',
            'Pemilu',
            'Pilkada',
            'Climate Change',
            'Sepak Bola',
            'Bulutangkis',
            'Film Terbaru',
            'Musik Indie',
            'Wisata Kuliner',
            'Destinasi Liburan',
            'Mobil Listrik'
        ];

        foreach ($tags as $name) {
            Tag::firstOrCreate(
                ['name' => $name],
                ['slug' => Str::slug($name)]
            );
        }
    }
}

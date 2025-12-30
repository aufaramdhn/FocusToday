<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@fokustoday.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
                'avatar' => 'https://ui-avatars.com/api/?name=Super+Admin&background=0D8ABC&color=fff',
                'is_onboarded' => true,
            ]
        );
        User::factory(2)->admin()->create();
        User::factory(2)->create([
            'role' => 'editor'
        ]);
        User::factory(2)->create();
    }
}

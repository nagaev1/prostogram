<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $friendsFactory = User::factory(10)
            ->has(Profile::factory())
            ->has(Post::factory()->count(10));
        User::factory()
            ->has(Profile::factory())
            ->has(Post::factory()->count(10))
            ->hasAttached(
                $friendsFactory,
                ['status' => 'confirmed'],
                'friends'
            )
            ->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => Hash::make('password')
            ]);
    }
}

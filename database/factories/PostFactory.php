<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Testing\Fakes\Fake;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $storageBasePath = Storage::disk('public')->path('');
        return [
            'caption' => fake()->text(120),
            'image' => function () use ($storageBasePath) {
                $imageRowPath = fake()->imageGenerator($storageBasePath . '/posts', 1000, 1000);
                return (str_replace($storageBasePath, '', $imageRowPath));
            },
            'created_at' => fake()->dateTimeThisMonth(),
        ];
    }
}

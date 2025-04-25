<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
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
            'bio' => fake()->text(60),
            'avatar' => function () use ($storageBasePath) {
                $imageRowPath = fake()->imageGenerator($storageBasePath . '/avatars', 300, 300);
                return (str_replace($storageBasePath, '', $imageRowPath));
            }
        ];
    }
}

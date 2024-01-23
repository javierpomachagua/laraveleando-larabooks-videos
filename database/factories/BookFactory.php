<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->text(30),
            'description' => fake()->realText(300),
            'image_path' => fake()->imageUrl(),
            'published_at' => fake()->dateTimeThisCentury(),
            'pages' => fake()->numberBetween(100, 800),
            'created_at' => fake()->dateTimeThisDecade(),
            'updated_at' => fake()->dateTimeThisDecade(),
        ];
    }
}

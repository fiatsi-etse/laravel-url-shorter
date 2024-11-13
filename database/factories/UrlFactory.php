<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Url>
 */
class UrlFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'originalUrl' => fake()->url(),
            'generatedUrl' => fake()->url(),
            'active' => fake()->numberBetween(0,1),
            'click' => fake()->randomNumber(5, false),
        ];
    }
}
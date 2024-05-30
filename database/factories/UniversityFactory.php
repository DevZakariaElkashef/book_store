<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\University>
 */
class UniversityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name_ar' => fake()->word(),
            'name_en' => fake()->word(),
            'description_ar' => fake()->sentence(),
            'description_en' => fake()->sentence(),
            'created_at' => fake()->dateTimeBetween('-3 months', 'now'),
            'is_active' => rand(0, 1)
        ];
    }
}

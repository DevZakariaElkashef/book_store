<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\College>
 */
class CollegeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'university_id' => rand(1, 20),
            'name_ar' => fake()->word(),
            'name_en' => fake()->word(),
            'description_ar' => fake()->sentence(),
            'description_en' => fake()->sentence(),
            'created_at' => Carbon::parse(fake()->dateTimeBetween('-3 months', 'now'))->format('Y-m-d H:i:s'),
            'is_active' => rand(0, 1),
            'image' => str_replace(['public', '\\'], ['', '/'], fake()->image('public/uploads/Colleges')),
        ];
    }
}

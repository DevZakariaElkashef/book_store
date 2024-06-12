<?php

namespace Database\Factories;

use Carbon\Carbon;
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
            'subject_id' => rand(1, 100),
            'name_ar' => fake()->word(),
            'name_en' => fake()->word(),
            'description_ar' => fake()->sentence(),
            'description_en' => fake()->sentence(),
            'author_ar' => fake()->name(),
            'author_en' => fake()->name(),
            'price' => rand(100, 1000),
            'is_new' => rand(0, 1),
            'created_at' => Carbon::parse(fake()->dateTimeBetween('-3 months', 'now'))->format('Y-m-d H:i:s'),
            'is_active' => rand(0, 1)
        ];
    }
}

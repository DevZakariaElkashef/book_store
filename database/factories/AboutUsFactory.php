<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AboutUs>
 */
class AboutUsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'content_ar' => fake()->sentence(),
            'content_en' => fake()->sentence(),
            'image' => str_replace('public', '', fake()->image('public/uploads/Aboutus', 640, 480, 'art4muslim')),
        ];
    }
}

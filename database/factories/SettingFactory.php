<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Setting>
 */
class SettingFactory extends Factory
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
            'short_description_ar' => fake()->sentence(),
            'short_description_en' => fake()->sentence(),
            'email' => fake()->safeEmail(),
            'phone' => fake()->phoneNumber,
            'address' => fake()->address(),
            'facebook' => fake()->url,
            'twitter' => fake()->url(),
            'instagram' => fake()->url(),
            'google' => fake()->url(),
            'slogan_ar' => fake()->sentence(),
            'slogan_en' => fake()->sentence(),
            'logo' => str_replace(['public', '\\'], ['', '/'], fake()->image('public/uploads/Setting')),
            'tax' => 15,
            'lat' => fake()->latitude(),
            'lng' => fake()->longitude(),
            'free_distance' => fake()->numberBetween(100, 200),
            'cost_per_km' => fake()->numberBetween(20, 50),
            'non_operational_distance' => fake()->numberBetween(1000, 20000),
            'expected_order_delivered' => fake()->numberBetween(1, 5)
        ];
    }
}

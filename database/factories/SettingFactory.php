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
            'facebook' => fake()->url,
            'twitter' => fake()->url(),
            'instagram' => fake()->url(),
            'google' => fake()->url(),
            'slogan_ar' => fake()->sentence(),
            'slogan_en' => fake()->sentence(),
            'logo' => str_replace('public', '', fake()->image('public/uploads/Setting')),
        ];
    }
}

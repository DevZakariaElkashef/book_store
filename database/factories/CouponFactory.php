<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coupon>
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => fake()->word(),
            'discount' => rand(1, 20),
            'max_times' => rand(100, 1000),
            'start_at' => fake()->date(),
            'end_at' => fake()->date(),
        ];
    }
}

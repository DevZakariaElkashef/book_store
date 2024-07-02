<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => rand(1, 20),
            'coupon_id' => rand(1, 20),
            'city_id' => rand(1, 20),
            'shipping' => rand(100, 1000),
            'sub_total' => rand(1000, 2000),
            'total' => rand(900, 2000),
            'payment_method' => rand(0, 1),
            'payment_status' => rand(0, 3),
            'order_status_id' => rand(1, 5),
            'transaction_id' => rand(111111, 555555),
            'note' => fake()->sentence(),
            'address' => fake()->address()
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\ContactType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
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
            'phone' => fake()->phoneNumber(),
            'email' =>fake()->email(),
            'message' => fake()->sentence(),
            'contact_type_id' => ContactType::factory()
        ];
    }
}

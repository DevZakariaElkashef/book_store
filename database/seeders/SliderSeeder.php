<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Slider::factory()->create([
            'key' => 'home-hero',
        ]);

        Slider::factory()->create([
            'key' => 'offer-section',
        ]);

        Slider::factory()->create([
            'key' => 'contact_us-section',
        ]);

        Slider::factory()->create([
            'key' => 'footer-section',
        ]);

        Slider::factory()->create([
            'key' => 'login-section',
        ]);

        Slider::factory()->create([
            'key' => 'register-section',
        ]);

        Slider::factory()->create([
            'key' => 'forget_password-section',
        ]);

        Slider::factory()->create([
            'key' => 'about_us-section',
        ]);

        Slider::factory()->create([
            'key' => 'universities-section',
        ]);

        Slider::factory()->create([
            'key' => 'used_books-section',
        ]);

        Slider::factory()->create([
            'key' => 'offers-section',
        ]);
    }
}

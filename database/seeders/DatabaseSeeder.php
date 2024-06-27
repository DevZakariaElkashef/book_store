<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\City;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $city = City::factory()->create();

        \App\Models\User::factory()->create([
            'name' => 'Zakaria Elkashef',
            'email' => 'z@z.com',
            'city_id' => $city->id,
        ]);




        $this->call([
            CitySeeder::class,
            UserSeeder::class,
            PermissionSeeder::class,
            UniversitySeeder::class,
            CollegeSeeder::class,
            SubjectSeeder::class,
            BookSeeder::class,
            CouponSeeder::class,
            CartSeeder::class,
            BookReviewSeeder::class,
            OrderStatusSeeder::class,
            OrderSeeder::class,
            OrderItemSeeder::class,
            ContactTypeSeeder::class,
            ContactSeeder::class,
            PageSeeder::class,
            SettingSeeder::class,
            AboutUsSeeder::class,
            SliderSeeder::class
        ]);
    }
}

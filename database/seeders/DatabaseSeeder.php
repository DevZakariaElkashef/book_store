<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        \App\Models\User::factory()->create([
            'name' => 'Zakaria Elkashef',
            'email' => 'z@z.com',
        ]);

        \App\Models\User::factory(100)->create();


        $this->call([
            PermissionSeeder::class,
            UniversitySeeder::class,
            CollegeSeeder::class,
            SubjectSeeder::class,
            BookSeeder::class,
            CouponSeeder::class,
            CartSeeder::class,
            CitySeeder::class,
            UserAddressSeeder::class,
            BookReviewSeeder::class,
            OrderStatusSeeder::class,
            OrderSeeder::class,
            OrderItemSeeder::class,
            ContactTypeSeeder::class,
            ContactSeeder::class,
            PageSeeder::class,
            SettingSeeder::class
        ]);
    }
}

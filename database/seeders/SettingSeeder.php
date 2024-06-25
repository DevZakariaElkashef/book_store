<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'name_ar' => 'book store',
            'name_en' => 'book store',
            'short_description_ar' => 'book store book store book store book store book store book store',
            'short_description_en' => 'book store book store book store book store book store book store',
            'email' => 'test@email.com',
            'phone' => '00000000',
            'facebook' => 'facebook.com',
            'twitter' => 'twitter.com',
            'instagram' => 'instagram.com',
            'google' => 'google.com',
            'slogan_ar' => 'slogan ar',
            'slogan_en' => 'slogan en',
            'logo' => 'logo.png',
        ]);
    }
}

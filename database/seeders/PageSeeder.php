<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Page::create([
            'key_ar' => 'الشروط والأحكام',
            'key_en' => 'Terms and Conditions',
            'value_ar' => 'الشروط والأحكام',
            'value_en' => 'Terms and Conditions',
        ]);
        
        
        Page::create([
            'key_ar' => 'نبذه عنا',
            'key_en' => 'About US',
            'value_ar' => 'نبذه عنا',
            'value_en' => 'About US',
        ]);
    }
}

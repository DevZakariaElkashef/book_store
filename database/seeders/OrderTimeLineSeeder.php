<?php

namespace Database\Seeders;

use App\Models\OrderTimeLine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderTimeLineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrderTimeLine::factory(2)->create();
    }
}

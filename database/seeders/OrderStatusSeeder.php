<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            ['ar' => 'فى الإنتظار', 'en' => 'Pending'],
            ['ar' => 'قيد التنفيذ', 'en' => 'In progress'],
            ['ar' => 'قيد التوصيل', 'en' => 'In delivery'],
            ['ar' => 'تم التوصيل', 'en' => 'Delivered'],
            ['ar' => 'تم الإلغاء', 'en' => 'Cancelled'],
        ];

        foreach ($statuses as $status) {
            OrderStatus::create([
                'name_ar' => $status['ar'],
                'name_en' => $status['en'],
            ]);
        }
    }
}

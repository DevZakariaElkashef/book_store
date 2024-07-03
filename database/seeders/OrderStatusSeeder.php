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
            ['ar' => 'فى الإنتظار', 'en' => 'Pending', 'color' => '#FDB528'],
            ['ar' => 'قيد التنفيذ', 'en' => 'In progress', 'color' => '#68D8FB'],
            ['ar' => 'قيد التوصيل', 'en' => 'In delivery', 'color' => '#666CFF'],
            ['ar' => 'تم التوصيل', 'en' => 'Delivered', 'color' => '#75E22B'],
            ['ar' => 'تم الإلغاء', 'en' => 'Cancelled', 'color' => '#FF4D49'],
        ];

        foreach ($statuses as $status) {
            OrderStatus::create([
                'name_ar' => $status['ar'],
                'name_en' => $status['en'],
                'color'=> $status['color'],
            ]);
        }
    }
}

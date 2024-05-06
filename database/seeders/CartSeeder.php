<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
           // create cart container
            $user->cart()->create([
                'type' => 0,
            ]);
            
            // create favorites container
            $user->cart()->create([
                'type' => 1,
            ]);
        }
    }
}

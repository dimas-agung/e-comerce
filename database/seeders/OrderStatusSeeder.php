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
        //
        $data = [
            [
                'name' => 'Waiting DP',
            ],
            [
                'name' => 'Ready DP',
            ],
            [
                'name' => 'Waiting Payment',
            ],
            [
                'name' => 'Ready Payment',
            ],
            [
                'name' => 'Ready Shipping',
            ],
            [
                'name' => 'Shipping',
            ],
            [
                'name' => 'Success',
            ],
            [
                'name' => 'Cancel',
            ],
        ];

       OrderStatus::insert($data);
    }
}
<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            [
                'product_categories_id' => 1,
                'product_code' => 1,
                'name' => 'Sepatu Adidas',
                'length' => 1,
                'width' => 1,
                'height' => 1,
                'weight' => 1,
                'picture_default' => 'DIMAS',
                'picture_1' => 'DIMAS',
                'picture_2' => 'DIMAS',
                'picture_3' => 'DIMAS',
                'picture_4' => 'DIMAS',
                'description' => 'Sepatu Elite no 12',
                'order_type' => 'PRE ORDER',
                'is_active' => 1,
            ],

        ];

       Product::insert($data);
    }
}
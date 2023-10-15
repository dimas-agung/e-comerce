<?php

namespace Database\Seeders;

use App\Models\Provinces;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvincesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'JAWA TIMUR',
            ],

        ];

       Provinces::insert($data);
    }
}
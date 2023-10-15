<?php

namespace Database\Seeders;

use App\Models\Village;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VillagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            [
                'name' => 'PLOSO',
                'districts_id' => 1,
                'cities_id' => 1,
                'provinces_id' => 1,
            ],

        ];

       Village::insert($data);
        
    }
}
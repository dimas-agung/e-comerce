<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            [
                'users_id' => 1,
                'provinces_id' => 1,
                'cities_id' => 1,
                'districts_id' => 1,
                'villages_id' => 1,
                'fullname' => 'DIMAS',
                'address' => 'Jln Kenangan no 12',
                'postal_code' => 1234,
                'phone_number' => 1234,
                'is_active' => 1,
            ],

        ];

       Address::insert($data);
    }
}
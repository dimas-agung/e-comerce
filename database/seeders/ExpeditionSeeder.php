<?php

namespace Database\Seeders;

use App\Models\Expedition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpeditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            [
                'name' => 'JNT',
            ],
            [
                'name' => 'JNE',
            ],
        ];

       Expedition::insert($data);
    }
}
<?php

namespace Database\Seeders;

use App\Models\Carousel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarouselSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            [
                'title' => 'Carousel 1',
                'description' => 'Carousel 1',
                'picture' => 'carousel/carousel_1.jpg',
            ],
            [
                'title' => 'Carousel 2',
                'description' => 'Carousel 2',
                'picture' => 'carousel/carousel_2.jpg',
            ],
            [
                'title' => 'Carousel 3',
                'description' => 'Carousel 3',
                'picture' => 'carousel/carousel_3.jpg',
            ],

        ];

       Carousel::insert($data);
    }
}

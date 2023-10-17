<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return  [
            'product_categories_id' => 1,
            'product_code' => 'SP23',
            'name' => 'Sepatu Adidas',
            'length' => 1,
            'width' => 1,
            'height' => 1,
            'weight' => 1,
            'picture_default' => $this->faker->imageUrl(width:500,height:500),
            'picture_1' => $this->faker->imageUrl(width:500,height:500),
            'picture_2' => $this->faker->imageUrl(width:500,height:500),
            'picture_3' => $this->faker->imageUrl(width:500,height:500),
            'picture_4' => $this->faker->imageUrl(width:500,height:500),
            'description' => 'Sepatu Elite no 12',
            'order_type' => 'PRE ORDER',
            'is_active' => 1,
        ];
    }
}
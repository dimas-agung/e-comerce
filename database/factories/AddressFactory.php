<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'users_id' => 1,
            'provinces_id' => 1,
            'cities_id' => 1,
            'districts_id' => 1,
            'villages_id' => 1,
            'fullname' => $this->faker->name(),
            'address' => $this->faker->address(),
                'postal_code' => 1234,
                'phone_number' => 1234,
                'is_active' => 1,
        ];
    }
}
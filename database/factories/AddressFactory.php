<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'full_address' => $this->faker->address(),
            'house_no' => $this->faker->buildingNumber(),
            'landmark' => $this->faker->secondaryAddress(),
            'pincode' => rand(100000, 999999),
            'latitude' => $this->faker->latitude(22.446713, 22.632607),
            'longitude' => $this->faker->longitude(88.243502, 88.449927),
            'type' => $this->faker->randomElement(['home', 'work', "dad's house", "friend house"]),
        ];
    }
}

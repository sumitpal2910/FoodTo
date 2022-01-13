<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ToppingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($this->faker));

        return [
            'name' => $this->faker->beverageName(),
            'price' => rand(10, 100),
            'qty' => rand(0, 100),
            'status' => rand(0, 1),
            'type' => rand(0, 1),
        ];
    }
}

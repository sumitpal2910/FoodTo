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
        $qty = rand(1, 1000);
        return [
            'name' => $this->faker->beverageName(),
            'price' => rand(10, 100),
            'qty' => $qty,
            'left_qty' => $qty,
            'status' => rand(0, 1),
            'veg' => rand(0, 1),
        ];
    }
}

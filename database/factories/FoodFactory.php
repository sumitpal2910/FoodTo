<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($this->faker));
        $name = $this->faker->foodName();
        return [
            'name' => $name,
            'slug' => str_replace(["--", "---"], "-", preg_replace("/[^a-zA-Z]/", '-', $name)),
            'thumbnail' => '',
            'price' => rand(50, 600),
            'description' => $this->faker->sentence(),
            'qty' => rand(0, 100),
            'status' => rand(0, 1),
            'type' => rand(0, 1),
        ];
    }
}

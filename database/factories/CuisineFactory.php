<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CuisineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->sentence(1);
        return [
            'name' => $name,
            'slug' => slug($name),
            'status' => rand(0, 1),
        ];
    }
}

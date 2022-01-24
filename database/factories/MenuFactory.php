<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->words(rand(1, 3), true);
        return [
            'title' => $name,
            'slug' => slug($name),
            'status' => rand(0, 1 ),
        ];
    }
}

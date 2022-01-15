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
            'slug' => str_replace(['--', '---'], '-', strtolower(preg_replace("/[^a-z0-9]/i", '-', $name))),
            'summary' => $this->faker->sentence(),
            'status' => rand(0, 1 ),
        ];
    }
}

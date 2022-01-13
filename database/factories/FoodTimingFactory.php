<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FoodTimingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'day' => $this->faker->dayOfWeek(),
            'open' => $this->faker->time(),
            'close' => $this->faker->time(),
            'status' => rand(0, 1)
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\RestaurantTiming;
use Illuminate\Database\Eloquent\Factories\Factory;

class RestaurantTimingFactory extends Factory
{

    protected $model = RestaurantTiming::class;
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

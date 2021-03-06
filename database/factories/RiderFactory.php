<?php

namespace Database\Factories;

use App\Models\Rider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RiderFactory extends Factory
{

    protected $model = Rider::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'pincode' => rand(111111, 999999),
        ];
    }

    /**
     * state
     */
    public function sumit()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Sumit Pal',
                'email' => 'rider@gmail.com',
            ];
        });
    }
}

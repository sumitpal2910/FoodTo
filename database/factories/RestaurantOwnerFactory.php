<?php

namespace Database\Factories;

use App\Models\RestaurantOwner;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

class RestaurantOwnerFactory extends Factory
{
    protected $model = RestaurantOwner::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        # make folder
        if (Storage::missing('owners')) {
            Storage::makeDirectory('owners');
        }
        $file = $this->faker->image('public\storage\owners', 640, 480, null, false);
        return [
            'name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'alt_phone' => $this->faker->phoneNumber(),
            'account_no' => $this->faker->randomNumber(8) . $this->faker->randomNumber(4),
            'ifsc' => $this->faker->randomNumber(6),
            'passbook' => "owners/{$file}",
        ];
    }
}

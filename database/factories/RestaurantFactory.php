<?php

namespace Database\Factories;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RestaurantFactory extends Factory
{

    protected $model = Restaurant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($this->faker));

        $name = $this->faker->company();
        $slug = strtolower(str_replace("--", '-', preg_replace("/[^a-z]/i", '-', $name)));
        if (Storage::missing("restaurants/{$slug}")) {
            Storage::makeDirectory("restaurants/{$slug}");
        }

        $path = "public/storage/restaurants/{$slug}";

        $kyc = $this->faker->image($path, 480, 640, null, false);
        $fssai = $this->faker->image($path, 480, 640, null, false);
        $license = $this->faker->image($path, 480, 640, null, false);
        $thumbnail = $this->faker->image($path, 256, 256, null, false);
        $bgImg = $this->faker->image($path, 1360, 430, null, false);
        $menu = $this->faker->image($path, 480, 640, null, false);

        $path = "restaurants/{$slug}/";

        return [
            'name' => $name,
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'slug' => $slug,
            'cuisine' => $this->faker->foodName(),
            'phone' => $this->faker->phoneNumber(),
            'alt_phone' => $this->faker->phoneNumber(),
            'gst_no' => $this->faker->randomNumber(8),
            'trade_name' => "{$name} Ltd",
            'license_no' => $this->faker->randomNumber(8),
            'fssai_no' => $this->faker->randomNumber(9),
            'kyc' => "{$path}{$kyc}",
            'thumbnail' => "{$path}{$thumbnail}",
            'bg_image' => "{$path}{$bgImg}",
            'fssai_image' => "{$path}{$fssai}",
            'license_image' => "{$path}{$license}",
            'menu' => "{$path}{$menu}",
            'full_address' => $this->faker->address(),
            'landmark' => $this->faker->buildingNumber(),
            'area' => $this->faker->streetName(),
            'longitude' => $this->faker->longitude(88.243502, 88.449927),
            'latitude' => $this->faker->latitude(22.446713, 22.632607),
            'pincode' => rand(100000, 999999),
            'status' => rand(0, 3),
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

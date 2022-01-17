<?php

namespace Database\Seeders;

use App\Models\Cuisine;
use App\Models\Restaurant;
use Illuminate\Database\Seeder;

class RestaurantCuisineTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $restaurants = Restaurant::get();

        $cuisines = Cuisine::get();

        foreach ($restaurants as $key => $value) {
            $value->cuisines()->attach($cuisines->random(rand(1, 3)));
        }
    }
}

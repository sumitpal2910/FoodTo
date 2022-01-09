<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Seeder;
use App\Models\RestaurantTiming;

class RestaurantTimingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $restaurants = Restaurant::get();

        foreach ($restaurants as $restaurant) {

            # make timing
            RestaurantTiming::factory(rand(1, 7))->make()->each(function ($timing) use ($restaurant) {
                $timing->restaurant_id = $restaurant->id;
                $timing->save();
            });
        }
    }
}

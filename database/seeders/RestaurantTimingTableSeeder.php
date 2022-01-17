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

            $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

            foreach ($days as $day) {
                $time = RestaurantTiming::factory()->make();
                $time->day = $day;
                $restaurant->timing()->save($time);
            }
        }
    }
}

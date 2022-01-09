<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Restaurant;
use App\Models\RestaurantManager;
use App\Models\RestaurantOwner;
use App\Models\RestaurantTiming;
use App\Models\State;
use Illuminate\Database\Seeder;

class RestaurantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $owners = RestaurantOwner::get();
        $cities = City::get();

        foreach ($owners as $owner) {
            # make restauant
            $restaurant = Restaurant::factory()->make();
            $restaurant->owner_id = $owner->id;
            $restaurant->state_id = $cities->random()->state_id;
            $restaurant->district_id = $cities->random()->district_id;
            $restaurant->city_id = $cities->random()->id;
            $restaurant->save();
        }
    }
}

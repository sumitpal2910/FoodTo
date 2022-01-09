<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use App\Models\RestaurantManager;
use Illuminate\Database\Seeder;

class RestaurantManagerTableSeeder extends Seeder
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
            # make manager
            RestaurantManager::factory()->create(['restaurant_id' => $restaurant->id]);
        }
    }
}

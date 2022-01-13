<?php

namespace Database\Seeders;

use App\Models\Food;
use App\Models\Restaurant;
use Illuminate\Database\Seeder;

class FoodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = (int) $this->command->ask('How many food do you want to create?', 100);

        $restaurants = Restaurant::get();

        Food::factory($count)->make()->each(function ($food) use ($restaurants) {
            $food->restaurant_id = $restaurants->random()->id;
            $food->save();
        });
    }
}

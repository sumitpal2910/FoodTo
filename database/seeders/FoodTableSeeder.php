<?php

namespace Database\Seeders;

use App\Models\Food;
use App\Models\Menu;
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

        $restaurants = Restaurant::has('menus')->with('menus')->get();

        Food::factory($count)->make()->each(function ($food) use ($restaurants) {
            $rest = $restaurants->random();
            $food->restaurant_id = $rest->id;
            $food->menu_id = $rest->menus->random()->id;
            $food->save();
        });
    }
}

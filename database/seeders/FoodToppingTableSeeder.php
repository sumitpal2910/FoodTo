<?php

namespace Database\Seeders;

use App\Models\Food;
use App\Models\Restaurant;
use App\Models\Topping;
use Illuminate\Database\Seeder;

class FoodToppingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rests = Restaurant::has('foods', '>=', 1)->has('toppings', '>=', 1)->with('foods', 'toppings')->get();

        foreach ($rests as $rest) {
            $food = $rest->foods->random();
            $toppings = $rest->toppings;

            $food->toppings()->attach($toppings->random(1, count($toppings) - 1));
        }
    }
}

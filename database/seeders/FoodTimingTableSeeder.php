<?php

namespace Database\Seeders;

use App\Models\Food;
use App\Models\FoodTiming;
use Illuminate\Database\Seeder;

class FoodTimingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $foods = Food::get();

        foreach ($foods as $food) {
            $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

            foreach ($days as $day) {
                $time = FoodTiming::factory()->make();
                $time->food_id = $food->id;
                $time->day = $day;
                $time->save();
            }
        }
    }
}

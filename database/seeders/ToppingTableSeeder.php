<?php

namespace Database\Seeders;

use App\Models\Food;
use App\Models\Topping;
use Illuminate\Database\Seeder;

class ToppingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = (int) $this->command->ask('How many food Toppings do you want to create?', 100);

        $foods = Food::get();

        Topping::factory($count)->make()->each(function ($topping) use ($foods) {
            $topping->food_id = $foods->random()->id;
            $topping->save();
        });
    }
}

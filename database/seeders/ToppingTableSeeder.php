<?php

namespace Database\Seeders;

use App\Models\Food;
use App\Models\Restaurant;
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

        $rests =  Restaurant::get();

        Topping::factory($count)->make()->each(function ($topping) use ($rests) {
            $topping->restaurant_id = $rests->random()->id;
            $topping->save();
        });
    }
}

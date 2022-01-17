<?php

namespace Database\Seeders;

use App\Models\Food;
use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuFoodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = Menu::get();

        $foods = Food::get();

        foreach ($menus as $key => $value) {
            $menus->random()->foods()->attach($foods->random(rand(1, count($foods) - 1)));
        }
    }
}

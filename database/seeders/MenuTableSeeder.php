<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Restaurant;
use Illuminate\Database\Seeder;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = (int) $this->command->ask('How many Menu would you want to create?', 10);

        $restaurants = Restaurant::get();

        Menu::factory($count)->make()->each(function ($menu) use ($restaurants) {
            $restaurants->random()->menus()->save($menu);
        });
    }
}

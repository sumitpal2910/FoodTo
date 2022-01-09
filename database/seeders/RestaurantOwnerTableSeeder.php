<?php

namespace Database\Seeders;

use App\Models\Bank;
use App\Models\RestaurantOwner;
use Illuminate\Database\Seeder;

class RestaurantOwnerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # get count
        $count = (int) $this->command->ask('How many Restaurants would you like to create?', 10);

        $banks = Bank::get();

        RestaurantOwner::factory($count)->make()->each(function ($owner) use ($banks) {
            $owner->bank_id = $banks->random()->id;
            $owner->save();
        });
    }
}

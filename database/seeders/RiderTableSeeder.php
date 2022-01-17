<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Rider;
use Illuminate\Database\Seeder;

class RiderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = (int) $this->command->ask('How many Rider would you like to create?', 10);

        $cities = City::get();

        Rider::factory($count)->create(['city_id' => $cities->random()->id]);
        Rider::factory()->sumit()->create(['city_id' => $cities->random()->id]);
    }
}

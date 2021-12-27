<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\District;
use App\Models\State;
use Illuminate\Database\Seeder;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = (int) $this->command->ask('How many city would you like to create?', 50);
        $states = State::with('district')->get();

        City::factory($count)->make()->each(function ($city) use ($states) {
            $state = $states->random();

            $city->state_id = $state->id;
            $city->district_id = $state->district->random()->id;
            $city->status = rand(0, 1);
            $city->save();
        });
    }
}

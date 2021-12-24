<?php

namespace Database\Seeders;

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

        Rider::factory($count)->create();
        Rider::factory()->sumit()->create();
    }
}

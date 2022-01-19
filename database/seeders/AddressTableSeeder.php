<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Seeder;

class AddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = (int) $this->command->ask('How many user address would you like to create?', 20);

        $users = User::get();

        Address::factory($count)->make()->each(function ($address) use ($users) {
            $address->user_id = $users->random()->id;
            $address->save();
        });
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Barryvdh\Debugbar\Facade;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = (int) $this->command->ask('How Many users would you like to create?', 10);

        User::factory($count)->create();
        User::factory()->sumit()->create();
    }
}

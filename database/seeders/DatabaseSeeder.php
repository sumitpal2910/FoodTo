<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if ($this->command->confirm('Do you want to refresh database?', true)) {
            $this->command->call('migrate:refresh');
            $this->command->info('Database was refreshed');

            # delete all file and folder
            Storage::deleteDirectory('restaurants');
            Storage::deleteDirectory('owners');
            Storage::deleteDirectory('users');
        }

        $this->call([
            UserTableSeeder::class,
            AdminTableSeeder::class,
            BankTableSeeder::class,
            StateDistrictTableSeeder::class,
            CityTableSeeder::class,
            RiderTableSeeder::class,
            RestaurantOwnerTableSeeder::class,
            RestaurantTableSeeder::class,
            RestaurantTimingTableSeeder::class,
            RestaurantManagerTableSeeder::class,
            FoodTableSeeder::class,
            ToppingTableSeeder::class,
            FoodTimingTableSeeder::class,
            MenuTableSeeder::class,
            MenuFoodTableSeeder::class,
            AddressTableSeeder::class,
        ]);
    }
}

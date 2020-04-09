<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // REMOVE BEFORE PRODUCTION
        $this->call(UsersTableSeeder::class);
        $this->Call(BusinessesTableSeeder::class);

        /// PRODUCTION
        $this->call(BusinessStatusSeeder::class);
    }
}

<?php

use Illuminate\Database\Seeder;

class UserBusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\UserBusiness::truncate();

        factory(\App\UserBusiness::class, 5)->create();
    }
}

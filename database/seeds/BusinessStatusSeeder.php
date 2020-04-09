<?php

use Illuminate\Database\Seeder;

class BusinessStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            [
                'id'    => '1',
                'value' => 'Active'
            ],
            [
                'id'    => '2',
                'value' => 'Inactive',
            ],
            [
                'id'    => '3',
                'value' => 'Deleted'
            ],
            [
                'id'    => '4',
                'value' => 'Review'
            ],
            [
                'id'    => '5',
                'value' => 'Banned'
            ]
        ];

        foreach ($statuses as $status) {

            \App\BusinessStatus::create($status);
        }
    }
}

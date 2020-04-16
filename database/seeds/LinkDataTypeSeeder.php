<?php

use Illuminate\Database\Seeder;

class LinkDataTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataTypes = [
            [
                'id' => 1,
                'value' => 'url'
            ],
            [
                'id' => 2,
                'value' => 'number'
            ],
            [
                'id' => 3,
                'value' => 'email'
            ]
        ];

        foreach ($dataTypes as $type) {
            \App\LinkDataType::create($type);
        }
    }
}

<?php

use Illuminate\Database\Seeder;

class LinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $links = [
            [
                'id' => '1',
                'name' => 'Uber Eats',
                'imagePath' => 'links/uberEats.png',
                'data_type' => '1'
            ],
            [
                'id' => '2',
                'name' => 'Rappi',
                'imagePath' => 'links/rappi.png',
                'data_type' => '1'
            ],
            [
                'id' => '3',
                'name' => 'Sin Delantal',
                'imagePath' => 'links/sinDelantal.png',
                'data_type' => '1'
            ],
            [
                'id' => '4',
                'name' => 'Didi Food',
                'imagePath' => 'links/didiFood.png',
                'data_type' => '1'
            ],
            [
                'id' => '5',
                'name' => 'Whatsapp',
                'imagePath' => 'links/whatsapp.png',
                'data_type' => '2'
            ],
            [
                'id' => '6',
                'name' => 'Facebook',
                'imagePath' => 'links/facebook.png',
                'data_type' => '1'
            ],
            [
                'id' => '7',
                'name' => 'Instagram',
                'imagePath' => 'links/instagram.png',
                'data_type' => '1'
            ],
            [
                'id' => '8',
                'name' => 'Twitter',
                'imagePath' => 'links/twitter.png',
                'data_type' => '1'
            ],
            [
                'id' => '9',
                'name' => 'Email',
                'imagePath' => 'links/email.png',
                'data_type' => '3'
            ],
            [
                'id' => '10',
                'name' => 'Teléfono',
                'imagePath' => 'links/telefono.png',
                'data_type' => '2'
            ],
            [
            'id' => '11',
            'name' => 'Página Web',
            'imagePath' => 'links/website.png',
            'data_type' => '1'
            ]
        ];

        foreach ($links as $link) {
            \App\Link::create($link);
        }
    }
}

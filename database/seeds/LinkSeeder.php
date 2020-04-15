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
                'imagePath' => 'links/uberEats.png'
            ],
            [
                'id' => '2',
                'name' => 'Rappi',
                'imagePath' => 'links/rappi.png'
            ],
            [
                'id' => '3',
                'name' => 'Sin Delantal',
                'imagePath' => 'links/sinDelantal.png'
            ],
            [
                'id' => '4',
                'name' => 'Didi Food',
                'imagePath' => 'links/didiFood.png'
            ],
            [
                'id' => '5',
                'name' => 'Whatsapp',
                'imagePath' => 'links/whatsapp.png'
            ],
            [
                'id' => '6',
                'name' => 'Facebook',
                'imagePath' => 'links/facebook.png'
            ],
            [
                'id' => '7',
                'name' => 'Instagram',
                'imagePath' => 'links/instagram.png'
            ],
            [
                'id' => '8',
                'name' => 'Twitter',
                'imagePath' => 'links/twitter.png'
            ],
            [
                'id' => '9',
                'name' => 'Email',
                'imagePath' => 'links/email.png'
            ],
            [
                'id' => '10',
                'name' => 'Teléfono',
                'imagePath' => 'links/telefono.png'
            ]
        ];

        foreach ($links as $link) {
            \App\Link::create($link);
        }
    }
}

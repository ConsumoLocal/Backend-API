<?php

use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            [
                'id' => 1,
                'name' => 'Aguascalientes',
                'latitude' => 21.885253,
                'longitude' => -102.289068
            ],
            [
                'id' => 2,
                'name' => 'Cancún',
                'latitude' => 21.166803,
                'longitude' => -86.850635
            ],
            [
                'id' => 3,
                'name' => 'Celaya',
                'latitude' => 20.527582,
                'longitude' => -100.811350
            ],
            [
                'id' => 4,
                'name' => 'Chihuahua',
                'latitude' => 28.632420,
                'longitude' => -106.069895
            ],
            [
                'id' => 5,
                'name' => 'Ciudad de México',
                'latitude' => 19.427595,
                'longitude' => -99.137441
            ],
            [
                'id' => 6,
                'name' => 'Ciudad Juárez',
                'latitude' => 31.690091,
                'longitude' => -106.421770
            ],
            [
                'id' => 7,
                'name' => 'Ciudad Obregón',
                'latitude' => 27.482182,
                'longitude' => -109.931269
            ],
            [
                'id' => 8,
                'name' => 'Ciudad Victoria',
                'latitude' => 23.736444,
                'longitude' => -99.141084
            ],
            [
                'id' => 9,
                'name' => 'Colima',
                'latitude' => 19.245069,
                'longitude' => -103.722772
            ],
            [
                'id' => 10,
                'name' => 'Cuernavaca',
                'latitude' => 18.924084,
                'longitude' => -99.220653
            ],
            /// 10 MARK
            [
                'id' => 11,
                'name' => 'Culiacán',
                'latitude' => 24.808329,
                'longitude' => -107.392073
            ],
            [
                'id' => 12,
                'name' => 'Durango',
                'latitude' => 24.025505,
                'longitude' => -104.651846
            ],
            [
                'id' => 13,
                'name' => 'Gómez Palacio',
                'latitude' => 25.588945,
                'longitude' => -103.488619
            ],
            [
                'id' => 14,
                'name' => 'Guadalajara',
                'latitude' => 20.686882,
                'longitude' => -103.350699
            ],
            [
                'id' => 15,
                'name' => 'Guanajuato',
                'latitude' => 21.018858,
                'longitude' => -101.257623
            ],
            [
                'id' => 16,
                'name' => 'Hermosillo',
                'latitude' => 29.083553,
                'longitude' => -110.953422
            ],
            [
                'id' => 17,
                'name' => 'Irapuato',
                'latitude' => 20.673768,
                'longitude' => -101.346744
            ],
            [
                'id' => 18,
                'name' => 'La Paz',
                'latitude' => 24.153674,
                'longitude' => -110.311236
            ],
            [
                'id' => 19,
                'name' => 'León',
                'latitude' => 21.122308,
                'longitude' => -101.682520
            ],
            [
                'id' => 20,
                'name' => 'Los Cabos',
                'latitude' => 22.882789,
                'longitude' => -109.913388
            ],
            // 20 MARK
            [
                'id' => 21,
                'name' => 'Los Mochis',
                'latitude' => 25.792653,
                'longitude' => -108.988774
            ],
            [
                'id' => 22,
                'name' => 'Mazatlán',
                'latitude' => 23.205279,
                'longitude' => -106.420143
            ],
            [
                'id' => 23,
                'name' => 'Mérida',
                'latitude' => 20.966963,
                'longitude' => -89.623111
            ],
            [
                'id' => 24,
                'name' => 'Mexicali',
                'latitude' => 32.624538,
                'longitude' => -115.452263
            ],
            [
                'id' => 25,
                'name' => 'Monterrey',
                'latitude' => 25.686613,
                'longitude' => -100.316116
            ],
            [
                'id' => 26,
                'name' => 'Morelia',
                'latitude' => 19.706223,
                'longitude' => -101.194972
            ],
            [
                'id' => 27,
                'name' => 'Navojoa',
                'latitude' => 27.081085,
                'longitude' => -109.446037
            ],
            [
                'id' => 28,
                'name' => 'Oaxaca',
                'latitude' => 17.062830,
                'longitude' => -96.734135
            ],
            [
                'id' => 29,
                'name' => 'Pachuca',
                'latitude' => 20.124618,
                'longitude' => -98.733994
            ],
            [
                'id' => 30,
                'name' => 'Puebla',
                'latitude' => 19.045098,
                'longitude' => -98.200971
            ],
            // 30  MARK

            [
                'id' => 31,
                'name' => 'Puerto Vallarta',
                'latitude' => 20.609547,
                'longitude' => -105.233886
            ],
            [
                'id' => 32,
                'name' => 'Querétaro',
                'latitude' => 20.597442,
                'longitude' => -100.386777
            ],
            [
                'id' => 33,
                'name' => 'Saltillo',
                'latitude' => 25.425068,
                'longitude' => -101.004083
            ],
            [
                'id' => 34,
                'name' => 'San Luis Potosí',
                'latitude' => 22.159453,
                'longitude' => -100.957788
            ],
            [
                'id' => 35,
                'name' => 'San Miguel de Allende',
                'latitude' => 20.913931,
                'longitude' => -100.742139
            ],
            [
                'id' => 36,
                'name' => 'Tampico',
                'latitude' => 22.214599,
                'longitude' => -97.856526
            ],
            [
                'id' => 37,
                'name' => 'Tepic',
                'latitude' => 21.515702,
                'longitude' => -104.890112
            ],
            [
                'id' => 38,
                'name' => 'Tijuana',
                'latitude' => 32.536748,
                'longitude' => -117.037101
            ],
            [
                'id' => 39,
                'name' => 'Toluca',
                'latitude' => 19.292068,
                'longitude' => -99.655288
            ],
            [
                'id' => 40,
                'name' => 'Torreón',
                'latitude' => 25.539691,
                'longitude' => -103.452260
            ],
            // 40 MARK

            [
                'id' => 41,
                'name' => 'Tuxtla Gutiérrez',
                'latitude' => 16.753687,
                'longitude' => -93.115880
            ],
            [
                'id' => 42,
                'name' => 'Veracruz',
                'latitude' => 19.197363,
                'longitude' => -96.134802
            ],
            [
                'id' => 43,
                'name' => 'Villahermosa',
                'latitude' => 17.990572,
                'longitude' => -92.925906
            ],
            [
                'id' => 44,
                'name' => 'Xalapa',
                'latitude' => 19.529913,
                'longitude' => -96.924734
            ],
            [
                'id' => 45,
                'name' => 'Zacatecas',
                'latitude' => 22.773277,
                'longitude' => -102.573111
            ],
        ];

        foreach ($cities as $city) {
            App\City::create($city);
        }
    }
}

<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'id' => 1,
                'value' => 'Comida'
            ],
            [
                'id' => 2,
                'value' => 'Servicios'
            ],
            [
                'id' => 3,
                'value' => 'Otros'
            ],
            // COMIDA
            [
                'id' => 4,
                'value' => 'Cafés y Tés',
                'parent' => 1
            ],
            [
                'id' => 5,
                'value' => 'Pizza',
                'parent' => 1
            ],
            [
                'id' => 6,
                'value' => 'Mexicana',
                'parent' => 1
            ],
            [
                'id' => 7,
                'value' => 'Americana',
                'parent' => 1
            ],
            [
                'id' => 8,
                'value' => 'Mariscos',
                'parent' => 1
            ],
            [
                'id' => 9,
                'value' => 'Sushi',
                'parent' => 1
            ],
            [
                'id' => 10,
                'value' => 'Cafetería',
                'parent' => 1
            ],
            [
                'id' => 11,
                'value' => 'Italiana',
                'parent' => 1
            ],
            [
                'id' => 12,
                'value' => 'Desayunos',
                'parent' => 1
            ],
            [
                'id' => 13,
                'value' => 'Comida Corrida',
                'parent' => 1
            ],
            // SERVICIOS
            [
                'id' => 14,
                'value' => 'Carpintería',
                'parent' => 2
            ],
            [
                'id' => 15,
                'value' => 'Cerrajería',
                'parent' => 2
            ],
            [
                'id' => 16,
                'value' => 'Diseño',
                'parent' => 2
            ],
            [
                'id' => 17,
                'value' => 'Psicología',
                'parent' => 2
            ],
            [
                'id' => 18,
                'value' => 'Impresiones',
                'parent' => 2
            ],
            [
                'id' => 19,
                'value' => 'Plomero',
                'parent' => 2
            ],
            [
                'id' => 20,
                'value' => 'Nutriología',
                'parent' => 2
            ],
            [
                'id' => 21,
                'value' => 'Fontanería',
                'parent' => 2
            ],

            // OTROS
            [
                'id' => 22,
                'value' => 'Ropa',
                'parent' => 3
            ],
            [
                'id' => 23,
                'value' => 'Calzado',
                'parent' => 3
            ],
            [
                'id' => 24,
                'value' => 'Abarrotes',
                'parent' => 3
            ],
            [
                'id' => 25,
                'value' => 'Productos de Limpieza',
                'parent' => 3
            ],
            [
                'id' => 26,
                'value' => 'Equipo Médico',
                'parent' => 3
            ],
            [
                'id' => 27,
                'value' => 'Papelería',
                'parent' => 3
            ],
            [
                'id' => 28,
                'value' => 'Insumos',
                'parent' => 3
            ],
            [
                'id' => 29,
                'value' => 'Joyería',
                'parent' => 3
            ],
            [
                'id' => 30,
                'value' => 'Reparación de Eléctronicos',
                'parent' => 3
            ],
            [
                'id' => 31,
                'value' => 'Fotografía',
                'parent' => 3
            ],
            [
                'id' => 32,
                'value' => 'Otros',
                'parent' => 3
            ],


        ];

        foreach ($categories as $category) {
            \App\Category::create($category);
        }
    }
}

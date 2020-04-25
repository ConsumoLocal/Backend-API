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
                'value' => 'Productos'
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
            [
                'id' => 14,
                'value' => 'Arabe',
                'parent' => 1
            ],
            [
                'id' => 15,
                'value' => 'Mediterranea',
                'parent' => 1
            ],
            [
                'id' => 16,
                'value' => 'Española',
                'parent' => 1
            ],
            [
                'id' => 17,
                'value' => 'Vietnamita',
                'parent' => 1
            ],
            [
                'id' => 18,
                'value' => 'Pasteles',
                'parent' => 1
            ],
            [
                'id' => 19,
                'value' => 'Gourmet',
                'parent' => 1
            ],
            [
                'id' => 20,
                'value' => 'Jugos y Licuados',
                'parent' => 1
            ],
            [
                'id' => 21,
                'value' => 'Brasileña',
                'parent' => 1
            ],
            [
                'id' => 22,
                'value' => 'Vegetariana',
                'parent' => 1
            ],
            // SERVICIOS
            [
                'id' => 23,
                'value' => 'Carpintería',
                'parent' => 2
            ],
            [
                'id' => 24,
                'value' => 'Cerrajería',
                'parent' => 2
            ],
            [
                'id' => 25,
                'value' => 'Diseño',
                'parent' => 2
            ],
            [
                'id' => 26,
                'value' => 'Psicología',
                'parent' => 2
            ],
            [
                'id' => 27,
                'value' => 'Impresiones',
                'parent' => 2
            ],
            [
                'id' => 28,
                'value' => 'Plomero',
                'parent' => 2
            ],
            [
                'id' => 29,
                'value' => 'Nutriología',
                'parent' => 2
            ],
            [
                'id' => 30,
                'value' => 'Fontanería',
                'parent' => 2
            ],
            [
                'id' => 31,
                'value' => 'Farmacia',
                'parent' => 2
            ],
            [
                'id' => 32,
                'value' => 'Académicos',
                'parent' => 2
            ],
            [
                'id' => 33,
                'value' => 'Veterinario',
                'parent' => 2
            ],
            [
                'id' => 34,
                'value' => 'Medicina',
                'parent' => 2
            ],
            [
                'id' => 35,
                'value' => 'Reparación',
                'parent' => 2
            ],
            [
                'id' => 36,
                'value' => 'Construcción',
                'parent' => 2
            ],
            [
                'id' => 37,
                'value' => 'Instalación',
                'parent' => 2
            ],
            [
                'id' => 38,
                'value' => 'Mecánica',
                'parent' => 2
            ],
            [
                'id' => 39,
                'value' => 'Papelería',
                'parent' => 2
            ],
            [
                'id' => 40,
                'value' => 'Digital',
                'parent' => 2
            ],
            [
                'id' => 41,
                'value' => 'Transporte',
                'parent' => 2
            ],
            [
                'id' => 42,
                'value' => 'Profesionistas',
                'parent' => 2
            ],
            [
                'id' => 43,
                'value' => 'Equipo Médico',
                'parent' => 2
            ],
            [
                'id' => 44,
                'value' => 'Enfermería',
                'parent' => 2
            ],
            [
                'id' => 45,
                'value' => 'Asistencia Médica',
                'parent' => 2
            ],
            [
                'id' => 46,
                'value' => 'Reparación de Electrónicos',
                'parent' => 2
            ],
            [
                'id' => 47,
                'value' => 'Fotografía',
                'parent' => 2
            ],
            [
                'id' => 48,
                'value' => 'Mercadotecnia',
                'parent' => 2
            ],
            [
                'id' => 64,
                'value' => 'Odontología',
                'parent' => 2
            ],

            // Productos
            [
                'id' => 49,
                'value' => 'Moda',
                'parent' => 3
            ],
            [
                'id' => 50,
                'value' => 'Calzado',
                'parent' => 3
            ],
            [
                'id' => 51,
                'value' => 'Abarrotes',
                'parent' => 3
            ],
            [
                'id' => 52,
                'value' => 'Limpieza',
                'parent' => 3
            ],
            [
                'id' => 53,
                'value' => 'Equipo Médico',
                'parent' => 3
            ],
            [
                'id' => 54,
                'value' => 'Papelería',
                'parent' => 3
            ],
            [
                'id' => 55,
                'value' => 'Insumos Alimenticios',
                'parent' => 3
            ],
            [
                'id' => 56,
                'value' => 'Joyería',
                'parent' => 3
            ],
            [
                'id' => 57,
                'value' => 'Farmacia',
                'parent' => 3
            ],
            [
                'id' => 58,
                'value' => 'Perecederos',
                'parent' => 3
            ],
            [
                'id' => 59,
                'value' => 'Deportes',
                'parent' => 3
            ],
            [
                'id' => 60,
                'value' => 'Estilo de vida',
                'parent' => 3
            ],
            [
                'id' => 61,
                'value' => 'Arte',
                'parent' => 3
            ],
            [
                'id' => 62,
                'value' => 'Ocio',
                'parent' => 3
            ],
            [
                'id' => 63,
                'value' => 'Otros',
                'parent' => 3
            ]
        ];

        foreach ($categories as $category) {
            \App\Category::create($category);
        }
    }
}

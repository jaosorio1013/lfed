<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ExampleProjectSeeder extends Seeder
{
    public function run(): void
    {

    }

    private function createProducts(): void
    {
        $productsByCategory = [
            'Obra Civil' => [
                [
                    'name' => 'Mortero de Nivelación',
                    'description' => 'Se aplica sobre el sustrato existente para nivelar la superficie, las juntas de dilatación se instalan en el perímetro y en lugares estratégicos del apartamento (cant 47 m²).',
                ],
                [
                    'name' => 'Estuco Paredes y Techo',
                    'description' => '',
                ],
                [
                    'name' => 'Revoque paredes',
                    'description' => '',
                ],
                [
                    'name' => 'Enchape Piso y zócalo',
                    'description' => '',
                ],
                [
                    'name' => 'Enchape de baños',
                    'description' => '',
                ],
                [
                    'name' => 'Techos en Drywall ',
                    'description' => '',
                ],
                [
                    'name' => 'Calentador / Red de agua caliente',
                    'description' => '',
                ],
            ],

            'Carpintería y Mobiliario' => [
                [
                    'name' => 'Cocina Integral ',
                    'description' => '',
                ],
                [
                    'name' => 'Isla en cocina ',
                    'description' => '',
                ],
                [
                    'name' => 'Closet y Vestier de habitaciones',
                    'description' => '',
                ],
                [
                    'name' => 'Muebles de baño y lavadero',
                    'description' => '',
                ],
                [
                    'name' => 'Puertas',
                    'description' => '',
                ],
            ],
        ];

        foreach ($productsByCategory as $category => $products) {
            $category = ProductCategory::where('name', $category)->firstOrFail();
            foreach ($products as $product) {
                $category->products()->firstOrCreate($product);
            }
        }
    }
}

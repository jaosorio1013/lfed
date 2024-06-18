<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategoriesSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Obra Civil',
            'Carpintería y Mobiliario',
            'Camas',
            'Tendidos y Almohadas',
            'Alfombras y Cuadros',
            'Lamparas e Iluminación',
            'Vidrios',
            'Cortineria',
            'Electrodomésticos',
            'Kit',
        ];

        foreach ($categories as $categoryName) {
            ProductCategory::create([
                'name' => $categoryName,
            ]);
        }
    }
}

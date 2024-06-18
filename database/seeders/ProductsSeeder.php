<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    public function run(): void
    {
        $this->createObraCivil();
        $this->createMobiliario();
        $this->createElectrodomesticos();
        $this->createCortineria();
        $this->createVidrios();
    }

    private function createProductsOnCategory(string $categoryName, array $products): void
    {
        $category = ProductCategory::firstOrCreate(['name' => $categoryName]);
        foreach ($products as $product) {
            $category->products()->firstOrCreate($product);
        }
    }

    private function createObraCivil(): void
    {
        $products = [
            [
                'name' => 'Pintura',
                'description' => 'Pintura lavable a 2 manos',
            ],
        ];

        $this->createProductsOnCategory('Obra civil', $products);
    }

    private function createMobiliario(): void
    {
        $products = [
            'name' => 'Nochero',
        ];

        $this->createProductsOnCategory('Carpintería y Mobiliario', $products);
    }

    private function createElectrodomesticos(): void
    {
        $products = [
            'name' => 'Cubierta',
        ];

        $this->createProductsOnCategory('Electrodomésticos', $products);
    }

    private function createCortineria(): void
    {
        $products = [

        ];

        $this->createProductsOnCategory('Cortineria', $products);
    }

    private function createVidrios(): void
    {
        $products = [

        ];

        $this->createProductsOnCategory('Vidrios', $products);
    }
}

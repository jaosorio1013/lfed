<?php

namespace Database\Factories;

use App\Models\Person;
use App\Models\Product;
use App\Models\ProductProjectProvider;
use App\Models\ProductSpace;
use App\Models\Project;
use App\Models\ProjectSpace;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProductProjectProviderFactory extends Factory
{
    protected $model = ProductProjectProvider::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'has_materiales' => $this->faker->boolean(),
            'has_transporte' => $this->faker->boolean(),
            'has_suministro' => $this->faker->boolean(),
            'has_instalacion' => $this->faker->boolean(),
            // 'quantity' => $this->faker->randomFloat(),
            // 'price_per_unit' => $this->faker->randomFloat(),
            // 'total' => $this->faker->randomFloat(),
            // 'valid_until' => $this->faker->dateTime(),

            'project_id' => Project::factory(),
            'provider_id' => Person::factory(),
            // 'product_id' => Product::factory(),
            // 'product_space_id' => ProductSpace::factory(),
        ];
    }
}

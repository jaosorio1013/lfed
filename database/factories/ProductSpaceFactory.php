<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductSpace;
use App\Models\ProjectSpace;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProductSpaceFactory extends Factory
{
    protected $model = ProductSpace::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),

            'product_id' => Product::factory(),
            'project_space_id' => ProjectSpace::factory(),
            'product_id' => Product::factory(),
        ];
    }
}

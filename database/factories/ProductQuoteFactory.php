<?php

namespace Database\Factories;

use App\Models\ProductCategory;
use App\Models\ProductProjectProvider;
use App\Models\ProductQuote;
use App\Models\Project;
use App\Models\Quote;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProductQuoteFactory extends Factory
{
    protected $model = ProductQuote::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'project_id' => Project::factory(),
            'quote_id' => Quote::factory(),
            'product_project_provider_id' => ProductProjectProvider::factory(),
            'product_category_id' => ProductCategory::inRandomOrder()->first()->id,
        ];
    }
}

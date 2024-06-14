<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductProjectProvider;
use App\Models\ProductQuote;
use App\Models\ProductSpace;
use App\Models\Project;
use App\Models\Quote;
use Illuminate\Database\Seeder;

class DevelopmentSeeder extends Seeder
{
    public function run(): void
    {
        $productCategories = ProductCategory::factory(5)->create();
        foreach ($productCategories as $productCategory) {
            Product::factory(5)->create(['product_category_id' => $productCategory->id]);
        }

        $products = Product::all();

        $projects = Project::factory(10)->create();
        foreach ($projects as $project) {
            $quote = Quote::factory()->create(['project_id' => $project->id]);
            $productSpaces = ProductSpace::factory(rand(1, 5))->create(['project_id' => $project->id]);
            foreach ($productSpaces as $productSpace) {
                if (rand(1, 5) < 4) {
                    $productSpace->update(['product_id' => $products->random()->id]);
                }

                $this->createProductProjectProvider($project->id, $quote->id, false, null, $productSpace->id);
            }

            if (rand(1, 5) < 4) {
                $this->createProductProjectProvider($project->id, $quote->id, false, $products->random()->id);
            }

            if (rand(1, 5) < 4) {
                $this->createProductProjectProvider($project->id, $quote->id, true);
            }
        }
    }

    private function createProductProjectProvider(
        int  $projectId,
        int  $quoteId,
        bool $isGroup,
        int  $productId = null,
        int  $productSpaceId = null
    ): void
    {
        $providerId = rand(1, 5);
        $parentId = null;
        if ($isGroup) {
            $parent = ProductProjectProvider::factory()->create([
                'project_id' => $projectId,
                'provider_id' => $providerId,
                'total' => rand(10000000, 50000000),
            ]);

            $parentId = $parent->id;

            ProductQuote::create([
                'product_project_provider_id' => $parentId,
                'project_id' => $projectId,
                'quote_id' => $quoteId,
            ]);
        }

        $quantity = rand(1, 10);
        $pricePerUnit = rand(10000, 100000);

        $productsProjectProvider = ProductProjectProvider::factory($isGroup ? 5 : 1)->create([
            'parent_id' => $parentId,
            'project_id' => $projectId,
            'provider_id' => $providerId,
            'product_id' => $productId,
            'product_space_id' => $productSpaceId,

            'quantity' => $parentId ? null : $quantity,
            'price_per_unit' => $parentId ? null : $pricePerUnit,
            'total' => $parentId ? null : $pricePerUnit * $quantity,

            'valid_until' => $parentId ? null : now()->addDays(rand(1, 30)),
        ]);

        if ($isGroup) {
            return;
        }

        foreach ($productsProjectProvider as $productProjectProvider) {
            ProductQuote::create([
                'product_project_provider_id' => $productProjectProvider->id,
                'project_id' => $projectId,
                'quote_id' => $quoteId,
            ]);
        }
    }
}

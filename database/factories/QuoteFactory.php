<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Quote;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class QuoteFactory extends Factory
{
    protected $model = Quote::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'identification' => $this->faker->word(),
            'subtotal' => $this->faker->randomFloat(1, 1000000, 50000000),
            'discount' => $this->faker->randomFloat(1, 0, 500000),
            'percentage_utilidad' => $this->faker->randomFloat(1, 1, 5),
            'percentage_administracion' => $this->faker->randomFloat(1, 1, 5),
            'percentage_inprevistos' => $this->faker->randomFloat(1, 1, 5),
            'percentage_retefuente' => $this->faker->randomFloat(1, 1, 5),
            'valid_until' => Carbon::now(),
            'sent_at' => Carbon::now(),
            'approved_at' => Carbon::now(),
            'rejected_at' => Carbon::now(),

            'project_id' => Project::factory(),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\ProjectSpace;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProjectSpaceFactory extends Factory
{
    protected $model = ProjectSpace::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'measures' => $this->faker->randomFloat(),
            'approved' => $this->faker->boolean(),

            'project_id' => Project::factory(),
        ];
    }
}

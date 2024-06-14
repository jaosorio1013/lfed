<?php

namespace Database\Factories;

use App\Models\Person;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'name' => $this->faker->name(),
            'won_at' => Carbon::now(),
            'lost_at' => Carbon::now(),
            'started_at' => Carbon::now(),
            'finished_at' => Carbon::now(),

            'client_id' => Person::factory(),
        ];
    }
}

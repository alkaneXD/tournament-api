<?php

namespace Database\Factories;

use App\Models\Round;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoundFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Round::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' => $this->faker->randomNumber(),
            'matches_count' => $this->faker->randomNumber(),
            'group_id' => \App\Models\Group::factory(),
        ];
    }
}

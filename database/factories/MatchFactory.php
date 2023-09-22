<?php

namespace Database\Factories;

use App\Models\Match;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class MatchFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Match::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' => $this->faker->randomNumber(),
            'opponent1_score' => $this->faker->randomNumber(),
            'opponent1_result' => $this->faker->text(255),
            'opponent1_position' => $this->faker->randomNumber(),
            'opponent2_score' => $this->faker->randomNumber(),
            'opponent2_result' => $this->faker->text(255),
            'opponent2_position' => $this->faker->randomNumber(),
        ];
    }
}

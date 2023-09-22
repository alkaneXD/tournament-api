<?php

namespace Database\Factories;

use App\Models\Fight;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class FightFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Fight::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'opponent1_score' => $this->faker->randomNumber(),
            'opponent1_result' => $this->faker->text(255),
            'opponent2_score' => $this->faker->randomNumber(),
            'opponent2_result' => $this->faker->text(255),
            'bracket_position' => $this->faker->randomNumber(),
        ];
    }
}

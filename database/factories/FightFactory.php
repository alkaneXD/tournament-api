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
            'player_one_id' => $this->faker->randomNumber(),
            'player_two_id' => $this->faker->randomNumber(),
            'winner_id' => $this->faker->randomNumber(),
            'bracket_position' => $this->faker->randomNumber(),
            'round_id' => \App\Models\Round::factory(),
        ];
    }
}

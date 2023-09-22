<?php

namespace Database\Seeders;

use App\Models\Round;
use Illuminate\Database\Seeder;

class RoundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Round::factory()
            ->count(5)
            ->create();
    }
}

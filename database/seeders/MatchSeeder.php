<?php

namespace Database\Seeders;

use App\Models\Match;
use Illuminate\Database\Seeder;

class MatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Match::factory()
            ->count(5)
            ->create();
    }
}

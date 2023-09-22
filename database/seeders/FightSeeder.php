<?php

namespace Database\Seeders;

use App\Models\Fight;
use Illuminate\Database\Seeder;

class FightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Fight::factory()
            ->count(5)
            ->create();
    }
}

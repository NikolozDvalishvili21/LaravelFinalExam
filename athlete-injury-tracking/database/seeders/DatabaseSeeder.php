<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\AthleteSeeder;
use Database\Seeders\InjurySeeder;
use Database\Seeders\TreatmentSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed athletes, injuries, and treatments
        $this->call([
            AthleteSeeder::class,
            InjurySeeder::class,
            TreatmentSeeder::class,
        ]);
    }
}


<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Athlete;
use App\Models\Injury;
use App\Models\Treatment;
use App\Models\Rating;
use Faker\Factory as Faker;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        
        $athletes = Athlete::all(); 
        foreach ($athletes as $athlete) {
            Rating::create([
                'rateable_id' => $athlete->id,
                'rateable_type' => Athlete::class,
                'rating' => $faker->numberBetween(1, 5), 
            ]);
        }

        
        $injuries = Injury::all(); 
        foreach ($injuries as $injury) {
            Rating::create([
                'rateable_id' => $injury->id,
                'rateable_type' => Injury::class,
                'rating' => $faker->numberBetween(1, 5), 
            ]);
        }

        
        $treatments = Treatment::all(); 
        foreach ($treatments as $treatment) {
            Rating::create([
                'rateable_id' => $treatment->id,
                'rateable_type' => Treatment::class,
                'rating' => $faker->numberBetween(1, 5), 
            ]);
        }
    }
}

<?php

namespace Database\Factories;

use App\Models\Injury;
use App\Models\Athlete;
use Illuminate\Database\Eloquent\Factories\Factory;

class InjuryFactory extends Factory
{
    protected $model = Injury::class;

    public function definition()
    {
        return [
            'athlete_id' => Athlete::factory(),
            'description' => $this->faker->sentence(),
            'injury_date' => $this->faker->date(),
            'follow_up_date' => $this->faker->date(),
            'status' => $this->faker->randomElement(['pending', 'in_progress', 'healed']),
        ];
    }
}


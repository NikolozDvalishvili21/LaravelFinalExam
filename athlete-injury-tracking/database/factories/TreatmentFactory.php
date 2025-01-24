<?php

namespace Database\Factories;

use App\Models\Treatment;
use App\Models\Injury;
use Illuminate\Database\Eloquent\Factories\Factory;

class TreatmentFactory extends Factory
{
    protected $model = Treatment::class;

    public function definition()
    {
        return [
            'injury_id' => Injury::factory(),
            'treatment_type' => $this->faker->word(),
            'treatment_date' => $this->faker->date(),
            'notes' => $this->faker->paragraph(),
        ];
    }
}


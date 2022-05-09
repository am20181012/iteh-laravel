<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Diagnosis>
 */
class DiagnosisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'date_of_diagnosis' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'latin_name' => $this->faker->word(),
            'description' => $this->faker->paragraph(),
            'cause' => $this->faker->word(),
            'hospitalization' => $this->faker->boolean($chanceOfGettingTrue = 50),
            'note' => $this->faker->paragraph()
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'card_num' => $this->faker->unique()->randomNumber($nbDigits = NULL, $strict = false),
            'name' => $this->faker->name(),
            'date_of_birth' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'gender' => $this->faker->randomElement($array = array ('m','f','-')),
            'adress'=> $this->faker->address(),
            'email' => $this->faker->unique()->safeEmail()
        ];
    }
}

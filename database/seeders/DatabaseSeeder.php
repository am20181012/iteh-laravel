<?php

namespace Database\Seeders;

use App\Models\Diagnosis;
use App\Models\Patient;
use App\Models\Therapy;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Patient::truncate();
        User::truncate();
        Therapy::truncate();
        Diagnosis::truncate();

        //users
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        //patients
        $patient1 = Patient::factory()->create([
            'user_id' => $user1->id
        ]);
        $patient2 = Patient::factory()->create([
            'user_id' => $user1->id
        ]);
        $patient3 = Patient::factory()->create([
            'user_id' => $user2->id
        ]);
        $patient4 = Patient::factory()->create([
            'user_id' => $user1->id
        ]);   

        //diagnosis
        $diagnosis1 = Diagnosis::factory(2)->create([
            'patient_id' => $patient2->id,
            'user_id' => $user1->id
        ]);

        $diagnosis2 = Diagnosis::factory()->create([
            'patient_id' => $patient1->id,
            'user_id' => $user1->id
        ]);

        $diagnosis3 = Diagnosis::factory()->create([
            'patient_id' => $patient4->id,
            'user_id' => $user1->id
        ]);

        $diagnosis4 = Diagnosis::factory(2)->create([
            'patient_id' => $patient3->id,
            'user_id' => $user2->id
        ]);

        //therapies
        $therapy1 = Therapy::factory(2)->create([
            'diagnosis_id' => $diagnosis1->first()->id
        ]);

        $therapy2 = Therapy::factory()->create([
            'diagnosis_id' => $diagnosis2->first()->id
        ]);

        $therapy3 = Therapy::factory(3)->create([
            'diagnosis_id' => $diagnosis4->first()->id
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Belt;
use App\Models\TrainingSession;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PurplesAndBluesSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //create a new training session
        $training_session = TrainingSession::factory()->create([
            'name' => 'Purples and Blues Session',
            'description' => 'This is a training session for the purples and blues'
        ]);

        //attach the blues and green techniques to the training session
        $purple = Belt::where('name', 'purple')->first()->techniques()->get();
        $blue = Belt::where('name', 'blue')->first()->techniques()->get();

        $training_session->techniques()->attach($purple);
        $training_session->techniques()->attach($blue);
    }
}

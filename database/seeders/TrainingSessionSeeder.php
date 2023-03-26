<?php

namespace Database\Seeders;

use App\Models\Technique;
use App\Models\TrainingSession;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrainingSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //make one training sesssion
        $training_session = TrainingSession::factory()->create([
            'name' => 'Test Training Session',
            'description' => 'This is a test training session'
        ]);

        //attach 10 techniques to the training session
        $techniques = Technique::inRandomOrder()->take(10)->get();
        $training_session->techniques()->attach($techniques);

        //make another training session
        $training_session = TrainingSession::factory()->create([
            'name' => 'All Techniques Training Session',
            'description' => 'This is a test training session with all the techniques in the system'
        ]);

        //attatch all techniques in the system to the training session
        $techniques = Technique::all();
        $training_session->techniques()->attach($techniques);

    }
}

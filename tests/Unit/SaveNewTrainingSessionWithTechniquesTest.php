<?php

namespace Tests\Unit;

use App\Models\Technique;
use Tests\TestCase;

class SaveNewTrainingSessionWithTechniquesTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_save_new_training_session(): void
    {

        //get 10 random techniques from the db
        $techniques = Technique::inRandomOrder()->take(10)->get();
        $data = $techniques->map(function ($technique) {
            return $technique->id;
        });

        print_r($data);

        //hit the route to create a new training session with a post request
        $this->postJson(route('training-sessions.store'), [
            'name' => 'My Training Session',
            'description' => 'This is a test training session',
            'techniques' => $data
        ])
        ->assertSuccessful()
        ->assertJson([
            'success' => 'true'
            ]);


        //assert that the training session was created

    }
}

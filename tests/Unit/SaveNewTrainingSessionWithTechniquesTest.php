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

        //hit the route to create a new training session with a post request
        $response = $this->postJson(route('training-sessions.store'), [
            'name' => 'My Training Session',
            'description' => 'This is a test training session',
            'techniques' => $data
        ])
        ->assertSuccessful()
        ->assertJsonStructure(
            [
                'success',
                'training_session_id'
            ]
        );

        $content = json_decode($response->content());
        //assert that the training session was created
        $this->assertDatabaseHas('training_sessions', [
            'id' => $content->training_session_id,
            'name' => 'My Training Session',
            'description' => 'This is a test training session',
        ]);

        //assert the techniques were attached to the session
        foreach($data as $technique){
            $this->assertDatabaseHas('technique_training_session', [
                'training_session_id' => $content->training_session_id,
                'technique_id' => $technique
            ]);
        }
    }
}

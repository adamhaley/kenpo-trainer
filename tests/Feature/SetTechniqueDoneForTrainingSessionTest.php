<?php

namespace Tests\Feature;

use App\Models\Technique;
use App\Models\TrainingSession;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SetTechniqueDoneForTrainingSessionTest extends TestCase
{
    //set up
    protected function setUp(): void
    {
        parent::setUp();
        $this->training_session = TrainingSession::factory()->create();
        //get a random technique
        $this->technique = Technique::inRandomOrder()->first();
        $this->training_session->techniques()->attach($this->technique);

    }

    /**
     * A basic feature test example.
     */
    public function test_set_technique_done_for_training_session(): void
    {
        //get a random training session technique
        $training_session_technique = $this->training_session->techniques()->inRandomOrder()->first();

        //hit endpoint to set technique done for training session
        $response = $this->postJson(route('training-sessions.set-technique-done', [
            'training_session_id' => $this->training_session->id,
            'technique_id' => $training_session_technique->id
            ])
        );

        dd($response->content());
    }
}

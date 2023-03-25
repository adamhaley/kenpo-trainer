<?php

namespace Tests\Feature;

use App\Models\Technique;
use App\Models\TrainingSession;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetRandomTechniqueNoRepeatsTest extends TestCase
{

    //set up
    protected function setUp(): void
    {
        parent::setUp();
        $this->training_session = TrainingSession::factory()->create();
        //attach 10 techniques to the training session
        $this->techniques = Technique::inRandomOrder()->take(10)->get();
        $this->training_session->techniques()->attach($this->techniques);
    }
    /**
     * Test get random technique no repeats.
     */
    public function test_get_random_technique_no_repeats(): void
    {
        //get a random technique
        $technique = $this->training_session->getRandomTechnique();
        //assert that the technique is not done
        $this->assertDatabaseHas('technique_training_session', [
            'training_session_id' => $this->training_session->id,
            'technique_id' => $technique->id,
            'done' => 0
        ]);
        //set the technique done
        $this->training_session->techniques()->updateExistingPivot($technique->id, ['done' => 1]);
        //get a random technique
        $technique = $this->training_session->getRandomTechnique();
        //assert that the technique is not done
        $this->assertDatabaseHas('technique_training_session', [
            'training_session_id' => $this->training_session->id,
            'technique_id' => $technique->id,
            'done' => 0
        ]);

    }
}

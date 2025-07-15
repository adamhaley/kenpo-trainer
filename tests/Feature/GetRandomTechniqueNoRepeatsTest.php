<?php

namespace Tests\Feature;

use App\Models\Technique;
use App\Models\TrainingSession;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetRandomTechniqueNoRepeatsTest extends TestCase
{
    use RefreshDatabase;
    
    //set up
    protected function setUp(): void
    {
        parent::setUp();
        
        // Seed the database with the full DatabaseSeeder
        $this->seed();
        
        $this->training_session = TrainingSession::factory()->create();
        //attach 10 techniques to the training session
        $techniques = Technique::inRandomOrder()->take(10)->get();
        $this->training_session->techniques()->attach($techniques);
    }
    /**
     * Test get random technique no repeats.
     */
    public function test_get_random_technique_no_repeats(): void
    {
        //get a random technique 10 times and assert that there are no repeats

//       dd( $this->training_session );

        $techniques = [];
        for ($i = 0; $i < 10; $i++) {
            $technique = $this->training_session->getRandomTechnique();

            //assert that the technique is not in the array to check for repeats
            $this->assertFalse(in_array($technique, $techniques));
            $techniques[] = $technique;

            //check that the technique is done
            $this->assertTrue($technique->getDoneForTrainingSession($this->training_session));
        }

    }
}

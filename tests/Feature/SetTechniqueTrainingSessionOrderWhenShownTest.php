<?php

namespace Tests\Feature;

use App\Models\Technique;
use App\Models\TechniqueTrainingSession;
use App\Models\TrainingSession;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SetTechniqueTrainingSessionOrderWhenShownTest extends TestCase
{
    use RefreshDatabase;
    
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
     * A basic feature test example.
     */
    public function test_set_technique_training_session_order_when_get_technique(): void
    {
        $techniques = [];
        for ($i = 0; $i < 10; $i++) {
            $technique = $this->training_session->getRandomTechnique();
            $techniques[] = $technique->getOrderForTrainingSession($this->training_session);
            $this->assertEquals($i+1, $technique->getOrderForTrainingSession($this->training_session));
        }
    }
}
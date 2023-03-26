<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technique extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'attack',
        'belt_id',
        ];

    /**
     * accessor method for belt
     */
    public function belt()
    {
         return $this->belongsTo(Belt::class);
    }

    public function trainingSessions()
    {
        return $this->belongsToMany(TrainingSession::class)
            ->using(TechniqueTrainingSession::class)
            ->withPivot('done');
    }

    //get whether technique is done for training session
    public function getDoneForTrainingSession(TrainingSession $trainingSession): bool
    {
        try {
            return $this->trainingSessions()->wherePivot('training_session_id', $trainingSession->id)->first()->pivot->done;
        } catch (\Exception $e) {
            throw new \Exception('Could not get technique done for training session');
        }
    }

    //set technique done for training session
    public function setDoneForTrainingSession(TrainingSession $trainingSession): void
    {

        try {
            $this->trainingSessions()->updateExistingPivot($trainingSession, ['done' => 1]);
        } catch (\Exception $e) {
            throw new \Exception('Could not set technique done for training session');
        }
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingSession extends Model
{
    use HasFactory;

    //set fillable fields
    protected $fillable = [
        'name',
        'description',
        'user_id'
    ];

    public function techniques()
    {
        return $this->belongsToMany(Technique::class)
            ->withPivot('done', 'order')
            ->withTimestamps();
    }

    public function getRandomTechnique(): Technique
    {
        //if all techniques are done, set all to not done
        $undoneCount = $this->techniques()->wherePivot('done', false)->count();
        if ($undoneCount === 0) {
            $techniqueIds = $this->techniques()->pluck('techniques.id');
            $this->techniques()->updateExistingPivot($techniqueIds, ['done' => false, 'order' => 0]);
        }
        //get random techqniue that is not done
        try {
            //set done
            $undoneTechniques = $this->techniques()->wherePivot('done', false)->get();
            $technique = $undoneTechniques->random();
            $this->techniques()->updateExistingPivot($technique->id, ['done' => true]);

            //set order
            //get highest order in this training session
            $highestOrder = $this->techniques()->wherePivot('done', true)->max('order') ?? 0;
            //increment by one and set order
            $technique->setOrderForTrainingSession($this, $highestOrder+1);
            return $technique;
        }
        catch (\Exception $e) {
            throw new \Exception('Could not get random technique: ' . $e->getMessage());
        }
    }

}




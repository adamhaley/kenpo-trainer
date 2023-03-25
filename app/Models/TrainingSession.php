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
        return $this->belongsToMany(Technique::class);
    }

    public function getRandomTechnique(): Technique
    {
        //if all techniques are done, set all to not done
        if ($this->techniques()->wherePivot('done', 0)->count() === 0) {
            $this->techniques()->updateExistingPivot($this->techniques()->pluck('techniques.id'), ['done' => 0]);
        }
        //get random techqniue that is not done
        try {
            //set done
            $technique = $this->techniques()->wherePivot('done', 0)->get()->random();
            $this->techniques()->updateExistingPivot($technique->id, ['done' => 1]);
            return $technique;
        }
        catch (\Exception $e) {
            throw new \Exception('Could not get random technique');
        }
    }

}




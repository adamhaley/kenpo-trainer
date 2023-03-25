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
        //get random techqniue that is not done
        try {
            return $this->techniques()->wherePivot('done', 0)->get()->random();
        }
        catch (\Exception $e) {
            throw new \Exception('Could not get random technique');
        }
    }

}




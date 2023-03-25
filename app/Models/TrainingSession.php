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

}




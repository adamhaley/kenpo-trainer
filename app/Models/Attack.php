<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attack extends Model
{
    use HasFactory;
    
    //get techniques that use this attack
    public function techniques()
    {
        return $this->belongsToMany(Technique::class);
    }
}

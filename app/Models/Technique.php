<?php

namespace App\Models;

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

}

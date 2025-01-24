<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Injury extends Model
{
    use HasFactory;

    protected $fillable = ['athlete_id', 'description', 'injury_date', 'follow_up_date', 'status'];

    // Injury belongs to an athlete
    public function athlete()
    {
        return $this->belongsTo(Athlete::class);
    }

    // Injury has many treatments
    public function treatments()
    {
        return $this->hasMany(Treatment::class);
    }

    public function ratings()
    {
        return $this->morphMany(Rating::class, 'rateable');
    }

}

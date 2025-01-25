<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Athlete extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'sport', 'email'];

    public function ratings()
    {
        return $this->morphMany(Rating::class, 'rateable');
    }


    public function injuries()
    {
        return $this->hasMany(Injury::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    use HasFactory;

    protected $fillable = ['injury_id', 'treatment_type', 'treatment_date', 'notes'];

    public function injury()
    {
        return $this->belongsTo(Injury::class);
    }

    public function ratings()
    {
        return $this->morphMany(Rating::class, 'rateable');
    }

}


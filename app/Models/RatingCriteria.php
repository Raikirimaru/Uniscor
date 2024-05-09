<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingCriteria extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'rating_id', 'criteria_id', 'score',
    ];

    public function criteria()
    {
        return $this->belongsTo(Criteria::class);
    }

    public function rating()
    {
        return $this->belongsTo(Rating::class);
    }

}

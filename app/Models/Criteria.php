<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'criteria';

    protected $fillable = [
        'name', 'description',
    ];

    public function ratingCriteria()
    {
        return $this->hasMany(RatingCriteria::class);
    }

}

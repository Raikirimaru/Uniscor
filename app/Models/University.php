<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'description', 'city', 'status', 'image'];

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function criteria()
    {
        return $this->belongsTo(Criteria::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}

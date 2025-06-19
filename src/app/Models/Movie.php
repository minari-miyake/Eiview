<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'release_date',
        'genre',
        'director',
        'poster_url',
        'rating',
        'duration',
    ];

    protected $casts = [
        'release_date' => 'date',
        'rating' => 'decimal:1',
    ];
}
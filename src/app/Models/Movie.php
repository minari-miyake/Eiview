<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // 追加
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory; // これを追加

    protected $fillable = [
        'title',
        'summary',
        'image_url',
        'director',
        'official_url',
        'description',
        'release_date',
        'genre',
        'poster_url',
        'rating',
        'duration',
    ];

    protected $casts = [
        'release_date' => 'date',
        'rating' => 'decimal:1',
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function averageRating()
    {
        return $this->reviews()->avg('rating') ?? $this->rating ?? 0;
    }

    // レビュー数を取得
    public function reviewCount()
    {
        return $this->reviews()->count();
    }

    public function favoritedByUsers()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }
}

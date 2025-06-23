<?php

namespace App\Models; // ← これを追加！

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['movie_id', 'user_id', 'rating', 'content', 'comment','title'];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function user()
{
    return $this->belongsTo(User::class);
}

}

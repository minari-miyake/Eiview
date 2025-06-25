<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    // 一括代入を許可する属性
    protected $fillable = [
        'movie_id',
        'user_id',
        'rating',
        'title',
        'comment', // 内容は "comment" に統一（'content' を使っていないなら削除）
    ];

    /**
     * 映画とのリレーション（1つのレビューは1つの映画に属する）
     */
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    /**
     * ユーザーとのリレーション（1つのレビューは1人のユーザーに属する）
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
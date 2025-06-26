<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        // レビューなどリレーションも読み込む場合
        $user->load('reviews.movie'); // 各レビューとその映画

        return view('users.profile', compact('user'));
    }
}
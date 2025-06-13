<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MypageController extends Controller
{
    public function index()
{
    $user = auth()->user();
    return view('mypage.index', compact('user'));
}
}
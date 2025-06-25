<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReviewHistoryController extends Controller
{
    public function index()
    {
        $reviews = Auth::user()->reviews()->with('movie')->latest()->paginate(10);
        return view('reviews.history', compact('reviews'));
    }
}

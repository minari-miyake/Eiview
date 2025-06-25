<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class ReviewHistoryController extends Controller
{
    public function index()
    {
        try {
            $reviews = Auth::user()->reviews()->with('movie')->latest()->paginate(10);
        } catch (\Exception $e) {
            $reviews = new LengthAwarePaginator(
                collect([]),
                0,
                10,
                1,
                ['path' => request()->url(), 'pageName' => 'page']
            );
        }
        return view('reviews.history', compact('reviews'));
    }
}
<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Movie;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::latest()->paginate(12); // ページネーション可
        return view('movies.index', compact('movies'));
    }
}

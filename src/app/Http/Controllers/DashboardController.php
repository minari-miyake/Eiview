<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $movies = Movie::paginate(20); // ページネーション付き
        return view('dashboard.index', compact('movies'));
    }

    public function show($id)
    {
        $movie = Movie::findOrFail($id);
        return view('dashboard.detail', compact('movie'));
    }
}

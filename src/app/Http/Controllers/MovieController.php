<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Review;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $query = Movie::query();

        if ($keyword) {
            $query->where('title', 'LIKE', "%{$keyword}%")
                  ->orWhere('genre', 'LIKE', "%{$keyword}%");
        }

        $movies = $query->paginate(20);

        return view('movies.index', compact('movies', 'keyword'));
    }

    public function show($id)
    {
        $movie = Movie::with('reviews.user')->findOrFail($id);
        return view('movies.show', compact('movie'));
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $query = Movie::query();

        if (!empty($keyword)) {
            $query->where('title', 'like', "%{$keyword}%");
            // 「genre」は削除したので条件から除く
        }

        $movies = $query->latest()->paginate(12);

        return view('movies.index', compact('movies', 'keyword'));
    }

    public function show($id)
    {
        $movie = Movie::with('reviews.user')->findOrFail($id); // レビュー情報も一緒に取得
        return view('movies.show', compact('movie'));
    }

     public function topRated()
    {
        // 全映画を取得して平均ratingで並び替え（レビュー付きのみ）
        $topRatedMovies = Movie::with('reviews')
            ->get()
            ->filter(fn($movie) => $movie->reviews->count() > 0)
            ->sortByDesc(fn($movie) => $movie->averageRating())
            ->take(5);

        return view('dashboard', compact('topRatedMovies'));
    }
}


<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $movies = Movie::with('reviews')->paginate(20);

        return view('admin.dashboard', compact('movies'));
    }

    public function show($id)
    {
        $movie = Movie::with('reviews')->findOrFail($id);

        return view('admin.movie_show', compact('movie'));
    }

    // ✅ 映画追加フォームの表示
    public function create()
    {
        return view('admin.create_movie','director', 'official_url');
    }

    // ✅ 映画の保存
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'nullable|string',
            'image_url' => 'nullable|url',
            'director' => 'nullable|string|max:255',
            
            'official_url' => 'nullable|url|max:255',
        ]);

        Movie::create($validated);

        return redirect('/admin/dashbord')->with('success', '映画が追加されました！');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    // 映画一覧（検索機能つき）
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $query = Movie::with('reviews')->orderBy('created_at', 'desc');

        if ($keyword) {
            $query->where('title', 'like', '%' . $keyword . '%')
                  ->orWhere('director', 'like', '%' . $keyword . '%');
        }

        $movies = $query->paginate(20);

        return view('admin.dashboard', compact('movies', 'keyword'));
    }

    // 映画詳細表示（レビュー・ユーザー情報含む）
    public function show($id)
    {
        $movie = Movie::with('reviews.user')->findOrFail($id);
        return view('admin.movie_show', compact('movie'));
    }

    // 映画追加フォーム
    public function create()
    {
        return view('admin.movie_create');
    }

    // 映画保存処理
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'summary'      => 'nullable|string|max:1000',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'director'     => 'nullable|string|max:255',
            'official_url' => 'nullable|url|max:255',
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('movie_images', 'public');
        }

        Movie::create([
            'title'        => $validated['title'],
            'summary'      => $validated['summary'] ?? '',
            'image_url'    => $path ? 'storage/' . $path : '',
            'director'     => $validated['director'] ?? null,
            'official_url' => $validated['official_url'] ?? null,
        ]);

        return redirect()->route('admin.dashboard')->with('success', '映画を追加しました。');
    }

    // 映画編集フォーム
    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        return view('admin.movie_edit', compact('movie'));
    }

    // 映画更新処理
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'summary'      => 'nullable|string|max:1000',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'director'     => 'nullable|string|max:255',
            'official_url' => 'nullable|url|max:255',
        ]);

        $movie = Movie::findOrFail($id);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('movie_images', 'public');
            $movie->image_url = 'storage/' . $path;
        }

        $movie->title        = $validated['title'];
        $movie->summary      = $validated['summary'] ?? null;
        $movie->director     = $validated['director'] ?? null;
        $movie->official_url = $validated['official_url'] ?? null;
        $movie->save();

        return redirect()->route('admin.dashboard')->with('success', '映画を更新しました。');
    }

    // 映画削除処理
    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();

        return redirect()->route('admin.dashboard')->with('success', '映画を削除しました。');
    }
}

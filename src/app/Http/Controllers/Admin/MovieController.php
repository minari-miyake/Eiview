<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    // ダッシュボード兼映画一覧表示
    public function index()
    {
        $movies = Movie::with('reviews')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.dashboard', compact('movies'));
    }

    // 映画の詳細表示（レビュー含む）
    public function show($id)
    {
        $movie = Movie::with('reviews')->findOrFail($id);
        return view('admin.movie_show', compact('movie'));
    }

    // 映画登録フォーム表示
    public function create()
    {
        return view('admin.movie_create');
    }

    // 映画登録処理
    // app/Http/Controllers/Admin/MovieController.php

public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'summary' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'director' => 'nullable|string|max:255',
        'official_url' => 'nullable|url|max:255',
    ]);

    $path = null;
    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('movies', 'public');
    }

    Movie::create([
        'title' => $validated['title'],
        'summary' => $validated['summary'] ?? '',
        'image_url' => $path ? 'storage/' . $path : '',
        'director' => $validated['director'] ?? null,
        'official_url' => $validated['official_url'] ?? null,
    ]);

    return redirect()->route('admin.dashboard')->with('success', '映画を追加しました。');
}

    // Admin\MovieController.php に追加

public function edit($id)
{
    $movie = Movie::findOrFail($id);
    return view('admin.movie_edit', compact('movie'));
}

public function update(Request $request, $id)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'summary' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 画像ファイル制限
        'director' => 'nullable|string|max:255',
         'official_url' => 'nullable|url|max:255',
    ]);

    $movie = Movie::findOrFail($id);

    if ($request->hasFile('image')) {
        // 画像を storage/app/public/movie_images に保存し、パスを取得
        $path = $request->file('image')->store('movie_images', 'public');
        $movie->image_url = 'storage/' . $path; // 公開URL用にパス変換
    }

    $movie->title = $validated['title'];
    $movie->summary = $validated['summary'] ?? '';
    $movie->director = $validated['director'] ?? null;
    $movie->official_url = $validated['official_url'] ?? null;
    $movie->save();

    return redirect()->route('admin.dashboard')->with('success', '映画を更新しました。');
}

public function destroy($id)
{
    $movie = Movie::findOrFail($id);
    $movie->delete();

    return redirect()->route('admin.dashboard')->with('success', '映画を削除しました。');
}

}


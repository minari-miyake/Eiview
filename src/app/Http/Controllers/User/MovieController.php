<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        try {
            $keyword = $request->input('keyword');

            $query = Movie::query();

            if (!empty($keyword)) {
                $query->where('title', 'like', "%{$keyword}%");
                // 「genre」は削除したので条件から除く
            }

            $movies = $query->latest()->paginate(12);
        } catch (\Exception $e) {
            $movies = new LengthAwarePaginator(
                collect([]), // 空のコレクション
                0, // 総件数
                12, // 1ページあたりの件数
                1, // 現在のページ
                ['path' => request()->url(), 'pageName' => 'page']
            );
            $keyword = '';
        }

        return view('movies.index', compact('movies', 'keyword'));
    }

    public function show($id)
    {
        try {
            $movie = Movie::with('reviews.user')->findOrFail($id); // レビュー情報も一緒に取得
        } catch (\Exception $e) {
            abort(404, '映画が見つかりません');
        }
        return view('movies.show', compact('movie'));
    }

     public function topRated()
{
    $topRatedMovies = Movie::with('reviews')
        ->get()
        ->filter(fn($movie) => $movie->reviews->count() > 0)
        ->sortByDesc(fn($movie) => $movie->averageRating())
        ->take(5);

    $user = auth()->user();
        $favoriteCount = $user ? $user->favoriteMovies()->count() : 0; 

    $reviewCount = $user ? $user->reviews()->count() : 0;

    return view('dashboard', [
        'topRatedMovies' => $topRatedMovies,
        'reviewCount' => $reviewCount,
         'favoriteCount' => $favoriteCount,
    ]);
}

}


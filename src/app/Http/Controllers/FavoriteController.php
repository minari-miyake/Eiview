<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class FavoriteController extends Controller
{
    // お気に入り追加/解除（トグル）
    public function toggle(Movie $movie)
    {
        $user = auth()->user();

        if ($user->favoriteMovies()->where('movie_id', $movie->id)->exists()) {
            $user->favoriteMovies()->detach($movie->id); // 解除
            return back()->with('status', 'お気に入りを解除しました');
        } else {
            $user->favoriteMovies()->attach($movie->id); // 追加
            return back()->with('status', 'お気に入りに追加しました');
        }
    }

    // お気に入り一覧表示
    public function index()
    {
        try {
            $user = auth()->user();
            $favoriteMovies = $user->favoriteMovies()->paginate(20);
        } catch (\Exception $e) {
            $favoriteMovies = new LengthAwarePaginator(
                collect([]), // 空のコレクション
                0, // 総件数
                20, // 1ページあたりの件数
                1, // 現在のページ
                ['path' => request()->url(), 'pageName' => 'page']
            );
        }

        return view('movies.favorites', compact('favoriteMovies'));
    }
}
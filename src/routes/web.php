<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\User\MovieController as UserMovieController;
use App\Http\Controllers\User\ReviewController as UserReviewController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\User\ReviewHistoryController;
use App\Models\Movie;

// トップページ（公開）
Route::get('/', function () {
    return view('welcome');
});

// 映画検索ページ（公開）
Route::get('/search', [SearchController::class, 'index'])->name('search');

// Breeze / Jetstream の認証ルート
require __DIR__.'/auth.php';

// 管理者ログイン画面・処理（ゲストのみアクセス可）
Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
});

// 管理者認証済みルート群（prefix admin）
Route::middleware(['auth'])->prefix('admin')->group(function () {
    // 映画管理ダッシュボード
    Route::get('/dashboard', [MovieController::class, 'index'])->name('admin.dashboard');

    // 映画CRUD
    Route::get('/movie/create', [MovieController::class, 'create'])->name('admin.movie.create');
    Route::post('/movie', [MovieController::class, 'store'])->name('admin.movie.store');
    Route::get('/movie/{id}', [MovieController::class, 'show'])->name('admin.movie.show');
    Route::get('/movie/{id}/edit', [MovieController::class, 'edit'])->name('admin.movie.edit');
    Route::put('/movie/{id}', [MovieController::class, 'update'])->name('admin.movie.update');
    Route::delete('/movie/{id}', [MovieController::class, 'destroy'])->name('admin.movie.destroy');

    // 管理者用レビュー削除
    Route::delete('/reviews/{review}', [AdminReviewController::class, 'destroy'])->name('admin.reviews.destroy');

    // 管理者ログアウト
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
});

// 認証済みユーザーのルート
Route::middleware(['auth', 'verified'])->group(function () {
    // ユーザーダッシュボード（上位映画表示）
    Route::get('/dashboard', function () {
        try {
            $movies = \App\Models\Movie::latest()->take(6)->get();
            $topRatedMovies = \App\Models\Movie::whereNotNull('rating')
                                              ->orderBy('rating', 'desc')
                                              ->take(5)
                                              ->get();
        } catch (\Exception $e) {
            $movies = collect([]);
            $topRatedMovies = collect([]);
        }
        return view('dashboard', compact('movies', 'topRatedMovies'));
    })->name('dashboard');

    // プロフィール
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 映画一覧・詳細（ユーザー用）
    Route::get('/movies', [UserMovieController::class, 'index'])->name('movies.index');
    Route::get('/movies/{id}', [UserMovieController::class, 'show'])->name('movies.show');

    // お気に入り登録・解除
    Route::post('/movies/{movie}/favorite', [FavoriteController::class, 'toggle'])->name('movies.favorite.toggle');
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('movies.favorites');

    // レビュー関連
    Route::post('/reviews', [UserReviewController::class, 'store'])->name('reviews.store');
    Route::get('/reviews/{review}/edit', [UserReviewController::class, 'edit'])->name('reviews.edit');
    Route::put('/reviews/{review}', [UserReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{review}', [UserReviewController::class, 'destroy'])->name('reviews.destroy');

    // 自分のレビュー履歴
    Route::get('/my-reviews', [ReviewHistoryController::class, 'index'])->name('my.reviews');
});

// Breeze / Jetstream の認証ルート
require __DIR__.'/auth.php';
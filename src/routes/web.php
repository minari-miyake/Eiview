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
use App\Http\Controllers\User\ReviewLikeController; // ← 追加済みでOK
use App\Models\Movie;

// 公開ページ
Route::get('/', fn () => view('welcome'));
Route::get('/search', [SearchController::class, 'index'])->name('search');

// 認証（Breeze/Jetstream）
require __DIR__.'/auth.php';

// 管理者ログイン（ゲストのみ）
Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
});

// 管理者ページ
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [MovieController::class, 'index'])->name('admin.dashboard');

    // 映画CRUD
    Route::get('/movie/create', [MovieController::class, 'create'])->name('admin.movie.create');
    Route::post('/movie', [MovieController::class, 'store'])->name('admin.movie.store');
    Route::get('/movie/{id}', [MovieController::class, 'show'])->name('admin.movie.show');
    Route::get('/movie/{id}/edit', [MovieController::class, 'edit'])->name('admin.movie.edit');
    Route::put('/movie/{id}', [MovieController::class, 'update'])->name('admin.movie.update');
    Route::delete('/movie/{id}', [MovieController::class, 'destroy'])->name('admin.movie.destroy');

    // レビュー削除（管理者）
    Route::delete('/reviews/{review}', [AdminReviewController::class, 'destroy'])->name('admin.reviews.destroy');

    // ログアウト（管理者）
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
});

// 認証済ユーザー用
Route::middleware(['auth', 'verified'])->group(function () {
    // ダッシュボード（上位映画など）
    Route::get('/dashboard', [UserMovieController::class, 'topRated'])->name('dashboard');

    // プロフィール
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 映画一覧・詳細
    Route::get('/movies', [UserMovieController::class, 'index'])->name('movies.index');
    Route::get('/movies/{id}', [UserMovieController::class, 'show'])->name('movies.show');

    // お気に入り映画
    Route::post('/movies/{movie}/favorite', [FavoriteController::class, 'toggle'])->name('movies.favorite.toggle');
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('movies.favorites');

    // レビュー投稿・編集・削除
    Route::post('/reviews', [UserReviewController::class, 'store'])->name('reviews.store');
    Route::get('/reviews/{review}/edit', [UserReviewController::class, 'edit'])->name('reviews.edit');
    Route::put('/reviews/{review}', [UserReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{review}', [UserReviewController::class, 'destroy'])->name('reviews.destroy');

    // 👍 いいね機能（レビュー）
    Route::post('/reviews/{review}/like', [ReviewLikeController::class, 'store'])->name('reviews.like');
    Route::delete('/reviews/{review}/unlike', [ReviewLikeController::class, 'destroy'])->name('reviews.unlike');

    // ❤️ いいねしたレビュー一覧
    Route::get('/likes', [ReviewLikeController::class, 'index'])->name('reviews.likes');

    // 自分のレビュー履歴
    Route::get('/my-reviews', [ReviewHistoryController::class, 'index'])->name('my.reviews');
});

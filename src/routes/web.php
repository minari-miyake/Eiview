<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\MovieController;
use App\Models\Movie;

// トップページ（公開）
Route::get('/', function () {
    return view('welcome');
});

// ユーザーダッシュボード（ログイン・認証済み）
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        try {
            $movies = Movie::latest()->take(6)->get();
        } catch (\Exception $e) {
            $movies = collect([]);
        }
        return view('dashboard', compact('movies'));
    })->name('dashboard');

    // プロフィール関連
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 映画検索ページ（公開）
Route::get('/search', [SearchController::class, 'index'])->name('search');

// 管理者ログイン画面・処理（ゲスト用ミドルウェアで制御）
Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
});

// 管理者認証済みルート群（prefix admin, authミドルウェア）
Route::middleware(['auth'])->prefix('admin')->group(function () {
    // 管理者ダッシュボード（映画一覧）
    Route::get('/dashboard', [MovieController::class, 'index'])->name('admin.dashboard');

    // 映画CRUD操作
    Route::get('/movie/create', [MovieController::class, 'create'])->name('admin.movie.create');
    Route::post('/movie', [MovieController::class, 'store'])->name('admin.movie.store');
    Route::get('/movie/{id}', [MovieController::class, 'show'])->name('admin.movie.show');
    Route::get('/movie/{id}/edit', [MovieController::class, 'edit'])->name('admin.movie.edit');
    Route::put('/movie/{id}', [MovieController::class, 'update'])->name('admin.movie.update');
    Route::delete('/movie/{id}', [MovieController::class, 'destroy'])->name('admin.movie.destroy');

    // 管理者ログアウト
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
});

// Breeze / Jetstream の認証ルート
require __DIR__.'/auth.php';

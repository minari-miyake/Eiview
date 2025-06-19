<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\AdminDashboardController;



// トップページ
Route::get('/', function () {
    return view('welcome');
});

// ユーザーのダッシュボード（ログイン・メール認証済み）
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ユーザー認証が必要なプロフィール関連
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 映画検索ページ（誰でもアクセス可能）
Route::get('/search', [SearchController::class, 'index'])->name('search');

// 管理者ログイン画面表示
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');

// 管理者ログイン処理
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');

//管理者映用画一覧//
Route::get('/admin/dashboard', [MovieController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/movie/create', [MovieController::class, 'create'])->name('admin.movie.create');
Route::get('/admin/movie/{id}', [AdminDashboardController::class, 'show'])->name('admin.movie.show');
Route::post('/admin/movie', [MovieController::class, 'store'])->name('admin.movie.store');

Route::get('/admin/movie/{id}/edit', [MovieController::class, 'edit'])->name('admin.movie.edit');
Route::put('/admin/movie/{id}', [MovieController::class, 'update'])->name('admin.movie.update');
Route::delete('/admin/movie/{id}', [MovieController::class, 'destroy'])->name('admin.movie.destroy');


// BreezeやJetstreamなどが用意する認証関連ルートを読み込み
require __DIR__.'/auth.php';

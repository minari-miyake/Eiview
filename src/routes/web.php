<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;

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

// 管理者ダッシュボード（ログイン必須）
// ※必要ならadmin専用ミドルウェアでさらに制限可能
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->middleware('auth')
    ->name('admin.dashboard');

// BreezeやJetstreamなどが用意する認証関連ルートを読み込み
require __DIR__.'/auth.php';

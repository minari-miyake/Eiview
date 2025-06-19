<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Movie;


class AdminController extends Controller
{
    /**
     * 管理者ログイン画面を表示
     */
    public function showLoginForm()
    {
        return view('admin.login');
    }

    /**
     * 管理者ログイン処理
     */
    public function login(Request $request)
    {
        // バリデーション
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // ログイン試行
        if (Auth::attempt($credentials)) {
            // ログイン成功後のユーザーが管理者か確認
            if (Auth::user()->is_admin) {
                return redirect()->route('admin.dashboard');
            } else {
                // 一般ユーザーならログアウト
                Auth::logout();
                return redirect()->route('admin.login')->withErrors([
                    'email' => '管理者権限がありません。',
                ]);
            }
        }

        // 認証失敗
        return back()->withErrors([
            'email' => 'メールアドレスまたはパスワードが正しくありません。',
        ]);
    }

    /**
     * 管理者用ダッシュボードの表示
     */
    public function dashboard()
    {
        // Movieと関連するreviewsを1ページ20件で取得
        $movies = Movie::with('reviews')->paginate(20);

        return view('admin.dashboard', compact('movies'));
    }

    /**
     * 管理者ログアウト処理（オプション）
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login')->with('status', 'ログアウトしました。');
    }
    
}


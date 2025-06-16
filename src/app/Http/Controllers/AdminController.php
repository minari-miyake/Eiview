<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // このビューを resources/views/admin/dashboard.blade.php に作成してください
        return view('admin.dashboard');
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

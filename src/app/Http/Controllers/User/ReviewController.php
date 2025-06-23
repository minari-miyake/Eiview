<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * レビュー投稿処理
     */
    public function store(Request $request)
    {
        // バリデーション
        $validated = $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'rating'   => 'required|integer|min:1|max:5',
            'title'    => 'nullable|string|max:255',
            'comment'  => 'required|string|max:200',
        ]);

        // 認証ユーザーID取得
        $userId = Auth::id();

        if (!$userId) {
            return response()->json(['message' => 'ログインが必要です。'], 401);
        }

        // レビュー作成（title は空文字でも保存されるように input を直接使用）
        $review = Review::create([
            'movie_id' => $validated['movie_id'],
            'user_id'  => $userId,
            'rating'   => $validated['rating'],
            'title'    => $request->input('title'), // ← ★重要
            'comment'  => $validated['comment'],
        ]);

        // ユーザー情報を取得
        $review->load('user');

        // JSON レスポンス
        return response()->json([
            'message' => 'レビューを投稿しました',
            'review'  => $review,
        ]);
    }
}

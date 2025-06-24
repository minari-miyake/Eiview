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
        $validated = $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'rating'   => 'required|integer|min:1|max:5',
            'title'    => 'nullable|string|max:255',
            'comment'  => 'required|string|max:200',
        ]);

        $userId = Auth::id();
        if (!$userId) {
            return response()->json(['message' => 'ログインが必要です。'], 401);
        }

        $review = Review::create([
            'movie_id' => $validated['movie_id'],
            'user_id'  => $userId,
            'rating'   => $validated['rating'],
            'title'    => $request->input('title'),
            'comment'  => $validated['comment'],
        ]);

        $review->load('user');

        return response()->json([
            'message' => 'レビューを投稿しました',
            'review'  => $review,
        ]);
    }

    /**
     * レビュー編集フォーム表示
     */
    public function edit(Review $review)
    {
        if ($review->user_id !== Auth::id()) {
            abort(403, '権限がありません');
        }

        return view('reviews.edit', compact('review'));
    }

    /**
     * レビュー更新処理
     */
    public function update(Request $request, Review $review)
    {
        if ($review->user_id !== Auth::id()) {
            abort(403, '権限がありません');
        }

        $validated = $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'title'   => 'nullable|string|max:255',
            'comment' => 'required|string|max:200',
        ]);

        $review->update([
            'rating'  => $validated['rating'],
            'title'   => $validated['title'],
            'comment' => $validated['comment'],
        ]);

        return redirect()->route('movies.show', $review->movie_id)
                         ->with('success', 'レビューを更新しました');
    }

    /**
     * レビュー削除処理
     */
    public function destroy(Review $review)
    {
        if ($review->user_id !== Auth::id()) {
            abort(403, '権限がありません');
        }

        $review->delete();

        return redirect()->route('movies.show', $review->movie_id)
                         ->with('success', 'レビューを削除しました');
    }
}

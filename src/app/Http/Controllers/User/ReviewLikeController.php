<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewLikeController extends Controller
{
    /**
     * レビューにいいねする
     */
    public function store(Review $review)
    {
        $user = Auth::user();

        if ($review->isLikedBy($user)) {
            return redirect()->back()->with('message', 'すでにいいねしています');
        }

        $review->likedByUsers()->attach($user->id);

        return redirect()->back()->with('message', 'いいねしました');
    }

    /**
     * レビューのいいねを解除する
     */
    public function destroy(Review $review)
    {
        $user = Auth::user();

        if (! $review->isLikedBy($user)) {
            return redirect()->back()->with('message', 'いいねはありません');
        }

        $review->likedByUsers()->detach($user->id);

        return redirect()->back()->with('message', 'いいねを解除しました');
    }

    /**
     * いいねしたレビュー一覧
     */
    public function index()
    {
        $user = Auth::user();

        // Eagerロード + 件数取得 + ページネーションで高速化
        $likedReviews = $user->likedReviews()
            ->with(['movie', 'user'])
            ->withCount('likedByUsers')  // ← N+1問題を回避
            ->latest()
            ->paginate(10);

        return view('reviews.likes', ['reviews' => $likedReviews]);
    }
}

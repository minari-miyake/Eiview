<?php

use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewLikeController extends Controller
{
    public function store(Review $review)
    {
        $user = Auth::user();
        if (! $review->isLikedBy($user)) {
            $review->likedByUsers()->attach($user->id);
        }

        return back();
    }

    public function destroy(Review $review)
    {
        $user = Auth::user();
        if ($review->isLikedBy($user)) {
            $review->likedByUsers()->detach($user->id);
        }

        return back();
    }
}

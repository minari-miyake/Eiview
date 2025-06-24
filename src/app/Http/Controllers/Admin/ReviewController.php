<?php
 
// app/Http/Controllers/Admin/ReviewController.php
namespace App\Http\Controllers\Admin;
 
use App\Http\Controllers\Controller;
use App\Models\Review;
 
class ReviewController extends Controller
{
    public function destroy(Review $review)
    {
        // 関連映画IDを取得
        $movieId = $review->movie_id;
 
        // レビュー削除
        $review->delete();
 
        // 映画詳細ページにリダイレクト
        return redirect()->route('admin.movie.show', $movieId)
                         ->with('success', 'レビューを削除しました。');
    }
}
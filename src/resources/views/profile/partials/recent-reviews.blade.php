<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 p-6">
    <h3 class="text-xl font-bold mb-4">最近のレビュー</h3>
    @if($recentReviews && $recentReviews->count() > 0)
        <ul class="space-y-3">
            @foreach($recentReviews as $review)
                <li class="border-b pb-2">
                    <a href="{{ route('movies.show', $review->movie_id) }}" class="font-semibold text-blue-600 hover:underline">
                        {{ $review->movie->title ?? '映画タイトルなし' }}
                    </a>
                    <p class="text-gray-700">{{ Str::limit($review->content, 100) }}</p>
                    <p class="text-sm text-gray-500">評価: {{ $review->rating ?? '-' }}</p>
                    <p class="text-xs text-gray-400">{{ $review->created_at->format('Y-m-d') }}</p>
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-gray-600">まだレビューがありません。</p>
    @endif
</div>

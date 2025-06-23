<form id="review-form" action="{{ route('reviews.store') }}" method="POST" class="bg-white border rounded p-4 shadow mb-6 hidden">
    @csrf
    <input type="hidden" name="movie_id" value="{{ $movie->id }}">

    {{-- 評価（星） --}}
    <label class="block text-sm font-medium mb-1">評価</label>
    <div id="star-rating" class="flex items-center space-x-1 mb-4">
        @for ($i = 1; $i <= 5; $i++)
            <svg data-value="{{ $i }}" class="w-6 h-6 text-gray-300 hover:text-yellow-400 cursor-pointer transition-colors" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.965h4.175c.969 0 1.371 1.24.588 1.81l-3.381 2.455 1.287 3.965c.3.921-.755 1.688-1.539 1.118L10 13.348l-3.381 2.455c-.784.57-1.838-.197-1.539-1.118l1.287-3.965L3.018 8.702c-.783-.57-.38-1.81.588-1.81h4.175L9.049 2.927z"/>
            </svg>
        @endfor
    </div>
    <input type="hidden" name="rating" id="rating" required>

    {{-- タイトル --}}
    <label class="block text-sm font-medium mb-1">タイトル</label>
    <input type="text" name="title" class="w-full border rounded px-3 py-2 mb-4" placeholder="タイトル（任意）">

    {{-- コメント --}}
    <label class="block text-sm font-medium mb-1">感想（200文字以内）</label>
    <textarea name="comment" class="w-full border rounded px-3 py-2 mb-4" rows="3" maxlength="200" required></textarea>

    {{-- 投稿ボタン --}}
    <div class="text-right">
        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            投稿
        </button>
    </div>
</form>

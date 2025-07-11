<x-app-layout>
    <div class="p-6 max-w-6xl mx-auto">
        {{-- 映画情報カード（背景と枠で囲み） --}}
        <div class="bg-white rounded-xl shadow-md border border-gray-200 p-6">
           <div class="flex flex-col md:flex-row gap-6">
                {{-- 左：画像 --}}
            <div class="md:w-1/3">
                @if ($movie->image_url)
                    <img src="{{ asset($movie->image_url) }}" alt="{{ $movie->title }}"
                         class="w-full rounded shadow object-contain max-h-[400px]">
                @else
                    <div class="text-sm text-gray-500">画像が登録されていません。</div>
                @endif
            </div>

            {{-- 右：詳細 --}}
            <div class="md:w-2/3 flex flex-col">
                <h1 class="text-3xl font-bold mb-4">
                    {{ $movie->title }}
                </h1>

                <form method="POST" action="{{ route('movies.favorite.toggle', $movie) }}" class="ml-4">
        @csrf
        <button type="submit" class="text-3xl focus:outline-none transition-transform duration-200 hover:scale-110">
            @if(auth()->user()->favoriteMovies->contains($movie))
                <!-- 塗りつぶしの赤いハート -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-red-500 hover:text-red-600 transition" fill="currentColor" viewBox="0 0 20 20">
                   <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" />
                </svg>
            @else
                <!-- 枠だけのグレーハート -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-gray-400 hover:text-red-400 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4.318 6.318a4.5 4.5 0 010 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
            @endif
        </button>
    </form>
  
                {{-- 評価 --}}
                <div class="flex items-center space-x-2 mb-4">
                    @for($i = 1; $i <= 5; $i++)
                        <svg class="w-6 h-6 {{ $i <= round($movie->averageRating()) ? 'text-yellow-400' : 'text-gray-300' }}"
                             fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.965h4.175c.969 0 1.371 1.24.588 1.81l-3.381 2.455 1.287 3.965c.3.921-.755 1.688-1.539 1.118L10 13.348l-3.381 2.455c-.784.57-1.838-.197-1.539-1.118l1.287-3.965L3.018 8.702c-.783-.57-.38-1.81.588-1.81h4.175L9.049 2.927z"/>
                        </svg>
                    @endfor
                    <span class="text-lg font-medium text-gray-700">{{ number_format($movie->averageRating(), 1) }}</span>
                </div>

                {{-- あらすじ --}}
                <h2 class="text-lg font-semibold mb-2">あらすじ</h2>
                @if($movie->summary)
                   <p class="text-sm text-gray-700 mb-4 whitespace-pre-wrap break-words">
                      {{ $movie->summary }}
                   </p>
                @else
                   <p class="text-sm text-gray-500 italic mb-4">あらすじは未登録です。</p>
                @endif

                {{-- 出演者 --}}
                <h2 class="text-lg font-semibold mb-2">出演者</h2>
                <p class="text-sm text-gray-700 mb-4 whitespace-pre-wrap break-words">
                    {{ $movie->director ?? '出演者情報は未登録です。' }}
                </p>


                {{-- 公式サイト --}}
                <h2 class="text-lg font-semibold mb-2">公式サイト</h2>
                @if($movie->official_url)
                    <a href="{{ $movie->official_url }}" target="_blank"
                       class="text-sm text-blue-600 underline hover:text-blue-800">
                        {{ $movie->official_url }}
                    </a>
                @else
                    <p class="text-sm text-gray-500 italic mb-4">公式サイトは未登録です。</p>
                @endif
            </div>
        </div>
    </div>

         {{-- ↓↓↓ レビュー一覧と投稿フォームを画像＋詳細の下に移動 ↓↓↓ --}}
        <div class="mt-10">
           <h2 class="text-4xl font-bold mb-6 flex items-center justify-between text-gray-800 border-b border-gray-300 pb-2">
    <span>📝 レビュー一覧</span>
                <button onclick="document.getElementById('review-form').classList.toggle('hidden')"
                        class="text-base bg-blue-600 text-white px-5 py-2 rounded-md shadow hover:bg-blue-700 transition">
                    レビューを書く
                </button>
            </h2>

            {{-- レビュー投稿フォーム --}}
            @include('reviews.form', ['movie' => $movie])

            {{-- レビューリスト --}}
            <div id="review-list" class="space-y-6">
                @forelse ($movie->reviews->sortByDesc('created_at') as $review)
                    <div class="review-item relative bg-white border border-gray-200 rounded-lg shadow p-6" data-review-id="{{ $review->id }}">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex items-center space-x-4">
                                <img src="{{ $review->user->icon_url ?? asset('default-icon.png') }}" alt="{{ $review->user->name }}のアイコン"
                                     class="w-14 h-14 rounded-full object-cover border border-gray-300 shadow-sm">
                                <div>
                                    <div class="text-base font-bold text-gray-800">{{ $review->user->name }} さん</div>
                                    <div class="flex items-center mt-1">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.965h4.175c.969 0 1.371 1.24.588 1.81l-3.381 2.455
                                                1.287 3.965c.3.921-.755 1.688-1.539 1.118L10 13.348l-3.381
                                                2.455c-.784.57-1.838-.197-1.539-1.118l1.287-3.965L3.018
                                                8.702c-.783-.57-.38-1.81.588-1.81h4.175L9.049 2.927z"/>
                                            </svg>
                                        @endfor
                                        <span class="ml-1 text-sm text-gray-700">★{{ $review->rating }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="text-sm text-gray-500 flex flex-col items-end">
                                <span>{{ $review->created_at->format('Y年m月d日') }}</span>

                                @if(auth()->check() && auth()->id() === $review->user_id)
                                    <div class="mt-1 space-x-2">
                                        <a href="{{ route('reviews.edit', $review->id) }}"
                                           class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">編集</a>

                                        <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" class="inline" onsubmit="return confirm('本当に削除しますか？');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">
                                                削除
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>

                        @if ($review->title)
                            <div class="text-lg font-semibold text-gray-900 mb-1 leading-tight">
                                {{ $review->title }}
                            </div>
                        @endif

                        <p class="text-sm text-gray-800 leading-tight whitespace-pre-wrap break-words">
                            {{ $review->comment ?? '（コメントなし）' }}
                        </p>

                        {{-- いいねボタン --}}
                       <form action="{{ $review->isLikedBy(auth()->user()) ? route('reviews.unlike', $review->id) : route('reviews.like', $review->id) }}" method="POST" class="absolute right-4 bottom-4">
    @csrf
    @if($review->isLikedBy(auth()->user()))
        @method('DELETE')
    @endif
    <button type="submit" class="flex items-center space-x-1 text-gray-600 hover:text-red-500 transition">
        <svg class="w-6 h-6 {{ $review->isLikedBy(auth()->user()) ? 'fill-pink-500' : 'fill-white stroke-current text-gray-400' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 
            7.5 3c1.74 0 3.41 0.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 
            5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
        </svg>
        <span>{{ $review->likedByUsers()->count() }}</span>
    </button>
</form>

                    </div>
                @empty
                    <p class="text-sm text-gray-600">レビューはまだありません。</p>
                @endforelse
            </div>

            {{-- 戻るリンク --}}
            <div class="mt-6 text-right">
                <a href="{{ route('movies.index') }}" class="text-blue-600 hover:underline">&lt; 映画一覧に戻る</a>
            </div>
        </div>
    </div>

    {{-- JS：星評価クリックとレビュー投稿の非同期処理 --}}
   <script>
document.addEventListener('DOMContentLoaded', () => {
    // 星評価クリック処理（reviews.form側の星に対応）
    const stars = document.querySelectorAll('#star-rating svg');
    const ratingInput = document.getElementById('rating');

    stars.forEach(star => {
        star.addEventListener('click', () => {
            const value = parseInt(star.dataset.value);
            ratingInput.value = value;

            stars.forEach(s => {
                const v = parseInt(s.dataset.value);
                if (v <= value) {
                    s.classList.add('text-yellow-400');
                    s.classList.remove('text-gray-300');
                } else {
                    s.classList.add('text-gray-300');
                    s.classList.remove('text-yellow-400');
                }
            });
        });
    });

    // フォーム送信の非同期処理
    const form = document.getElementById('review-form');
    form.addEventListener('submit', async function(e) {
        e.preventDefault();

        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        const formData = new FormData(form);

        try {
            const response = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json'
                },
                body: formData
            });

            if (response.ok) {
                const data = await response.json();
                const review = data.review;

                // 既に同じIDのレビューがないかチェック
                if (!document.querySelector(`#review-list .review-item[data-review-id="${review.id}"]`)) {
                    const iconUrl = review.user.icon_url || '{{ asset("default-icon.png") }}';
                    const createdAt = new Date(review.created_at).toLocaleDateString('ja-JP');

                    // 星評価のSVG生成関数
                    function generateStars(rating) {
                        let starsHtml = '';
                        for (let i = 1; i <= 5; i++) {
                            starsHtml += `
                                <svg class="w-4 h-4 ${i <= rating ? 'text-yellow-400' : 'text-gray-300'}" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.965h4.175c.969 0
                                  1.371 1.24.588 1.81l-3.381 2.455 1.287 3.965c.3.921-.755
                                  1.688-1.539 1.118L10 13.348l-3.381
                                  2.455c-.784.57-1.838-.197-1.539-1.118l1.287-3.965L3.018
                                  8.702c-.783-.57-.38-1.81.588-1.81h4.175L9.049 2.927z"/>
                                </svg>`;
                        }
                        return starsHtml;
                    }

                    const reviewHtml = `
                        <div class="review-item bg-white border border-gray-200 rounded-lg shadow p-6" data-review-id="${review.id}">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex items-center space-x-4">
                                    <img src="${iconUrl}" alt="${review.user.name}のアイコン" class="w-14 h-14 rounded-full object-cover border border-gray-300 shadow-sm">
                                    <div>
                                        <div class="text-base font-bold text-gray-800">${review.user.name} さん</div>
                                        <div class="flex items-center mt-1">
                                            ${generateStars(review.rating)}
                                            <span class="ml-1 text-sm text-gray-700">★${review.rating}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-sm text-gray-500 flex flex-col items-end">
                                    <span>${createdAt}</span>
                                    ${review.user.id === {{ auth()->id() ?? 'null' }} ? `
                                    <div class="mt-1 space-x-2">
                                        <a href="/reviews/${review.id}/edit" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">編集</a>
                                        <form action="/reviews/${review.id}" method="POST" class="inline" onsubmit="return confirm('本当に削除しますか？');">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">削除</button>
                                        </form>
                                    </div>` : ''}
                                </div>
                            </div>
                            ${review.title ? `<div class="text-lg font-semibold text-gray-900 mb-1 leading-tight">${review.title}</div>` : ''}
                            <p class="text-sm text-gray-800 leading-tight whitespace-pre-line">${review.comment || '（コメントなし）'}</p>
                        </div>
                    `;
                    document.getElementById('review-list').insertAdjacentHTML('afterbegin', reviewHtml);
                }

                // フォームリセット、星評価リセット、非表示
                form.reset();
                ratingInput.value = '';
                stars.forEach(s => {
                    s.classList.add('text-gray-300');
                    s.classList.remove('text-yellow-400');
                });
                form.classList.add('hidden');
            } else {
                const errorData = await response.json().catch(() => null);
                alert('投稿に失敗しました: ' + (errorData?.message || '不明なエラー'));
                console.error('投稿エラー:', errorData);
            }
        } catch (error) {
            alert('通信エラーが発生しました');
            console.error(error);
        }
    });
});
</script>
</x-app-layout>

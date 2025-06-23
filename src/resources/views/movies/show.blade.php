<x-app-layout>
    <div class="p-6 max-w-6xl mx-auto">
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
                <h1 class="text-3xl font-bold mb-4">{{ $movie->title }}</h1>

                {{-- 評価 --}}
                <div class="flex items-center space-x-2 mb-4">
                    @for($i = 1; $i <= 5; $i++)
                        <svg class="w-6 h-6 {{ $i <= round($movie->averageRating()) ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.965h4.175c.969 0 1.371 1.24.588 1.81l-3.381 2.455 1.287 3.965c.3.921-.755 1.688-1.539 1.118L10 13.348l-3.381 2.455c-.784.57-1.838-.197-1.539-1.118l1.287-3.965L3.018 8.702c-.783-.57-.38-1.81.588-1.81h4.175L9.049 2.927z"/>
                        </svg>
                    @endfor
                    <span class="text-lg font-medium text-gray-700">{{ number_format($movie->averageRating(), 1) }}</span>
                </div>

                {{-- あらすじ --}}
                <h2 class="text-lg font-semibold mb-2">あらすじ</h2>
                @if($movie->summary)
                    <p class="text-sm text-gray-700 mb-4 whitespace-pre-line">{{ $movie->summary }}</p>
                @else
                    <p class="text-sm text-gray-500 italic mb-4">あらすじは未登録です。</p>
                @endif

                {{-- 出演者 --}}
                <h2 class="text-lg font-semibold mb-2">出演者</h2>
                <p class="text-sm text-gray-700 mb-4">
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

                {{-- レビュー --}}
                <h2 class="text-lg font-semibold mt-6 mb-3">
                    レビュー一覧
                    <button onclick="document.getElementById('review-form').classList.toggle('hidden')"
                       class="text-sm bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
                       レビューを書く
                    </button>
                </h2>

                {{-- レビュー投稿フォーム（reviews.formを@include） --}}
                @include('reviews.form', ['movie' => $movie])

                {{-- レビューリスト --}}
                <div id="review-list">
                    @foreach ($movie->reviews->sortByDesc('created_at') as $review)
                        <div class="review-item border-t py-4" data-review-id="{{ $review->id }}">
                            <div class="font-bold">{{ $review->user->name }} さん - ★{{ $review->rating }}</div>
                            @if ($review->title)
                                <div class="text-lg font-semibold">{{ $review->title }}</div>
                            @endif
                            <p>{{ $review->comment }}</p>
                        </div>
                    @endforeach
                </div>

                {{-- 戻る --}}
                <div class="mt-6 text-right">
                    <a href="{{ route('movies.index') }}" class="text-blue-600 hover:underline">&lt; 映画一覧に戻る</a>
                </div>
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
                        const reviewHtml = `
                            <div class="review-item border-t py-4" data-review-id="${review.id}">
                                <div class="font-bold">${review.user.name} さん - ★${review.rating}</div>
                                ${review.title ? `<div class="text-lg font-semibold">${review.title}</div>` : ''}
                                <p>${review.comment}</p>
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

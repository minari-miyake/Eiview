<x-app-layout>
    <div class="max-w-3xl mx-auto p-6 bg-white rounded shadow mt-10">
        <h1 class="text-2xl font-bold mb-6">レビューを編集</h1>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('reviews.update', $review->id) }}">
            @csrf
            @method('PUT')

            {{-- 評価（星） --}}
            <label class="block font-semibold mb-2">評価</label>
            <div class="flex items-center mb-4 space-x-1" id="rating-stars">
                @for ($i = 1; $i <= 5; $i++)
                    <label>
                        <input type="radio" name="rating" value="{{ $i }}" class="hidden"
                               {{ $review->rating == $i ? 'checked' : '' }} />
                        <svg data-value="{{ $i }}" class="star w-8 h-8 cursor-pointer transition-colors duration-200
                            {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}"
                             fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.965h4.175c.969 0 
                                1.371 1.24.588 1.81l-3.381 2.455 1.287 3.965c.3.921-.755 1.688-1.539 
                                1.118L10 13.348l-3.381 2.455c-.784.57-1.838-.197-1.539-1.118l1.287-3.965
                                L3.018 8.702c-.783-.57-.38-1.81.588-1.81h4.175L9.049 2.927z"/>
                        </svg>
                    </label>
                @endfor
            </div>
            @error('rating')
                <p class="text-red-600 mb-4">{{ $message }}</p>
            @enderror

            {{-- タイトル --}}
            <label for="title" class="block font-semibold mb-1">タイトル（任意）</label>
            <input type="text" id="title" name="title" value="{{ old('title', $review->title) }}"
                   class="w-full mb-4 border rounded p-2" maxlength="255" />
            @error('title')
                <p class="text-red-600 mb-4">{{ $message }}</p>
            @enderror

            {{-- コメント --}}
            <label for="comment" class="block font-semibold mb-1">感想</label>
            <textarea id="comment" name="comment" rows="5"
                      class="w-full mb-4 border rounded p-2" maxlength="200" required>{{ old('comment', $review->comment) }}</textarea>
            @error('comment')
                <p class="text-red-600 mb-4">{{ $message }}</p>
            @enderror

            <div class="flex justify-between items-center">
                <a href="{{ route('movies.show', $review->movie_id) }}" class="text-gray-600 hover:underline">
                    &lt; キャンセル
                </a>

                <button type="submit"
                        class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                    更新する
                </button>
            </div>
        </form>
    </div>

    {{-- 星評価スクリプト --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const stars = document.querySelectorAll('.star');
            const radios = document.querySelectorAll('input[name="rating"]');

            stars.forEach(star => {
                star.addEventListener('click', () => {
                    const selectedValue = parseInt(star.getAttribute('data-value'));

                    // ラジオボタンの状態を更新
                    radios.forEach(radio => {
                        radio.checked = parseInt(radio.value) === selectedValue;
                    });

                    // 星の色を更新
                    stars.forEach(s => {
                        const val = parseInt(s.getAttribute('data-value'));
                        if (val <= selectedValue) {
                            s.classList.add('text-yellow-400');
                            s.classList.remove('text-gray-300');
                        } else {
                            s.classList.remove('text-yellow-400');
                            s.classList.add('text-gray-300');
                        }
                    });
                });
            });
        });
    </script>
</x-app-layout>

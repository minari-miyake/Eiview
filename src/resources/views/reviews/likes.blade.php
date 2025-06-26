<x-app-layout>
    <div class="p-6 max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold mb-6">❤️ いいねしたレビュー一覧</h1>

        @if ($reviews->isEmpty())
            <p class="text-xl text-gray-500 text-center">まだいいねしたレビューはありません。</p>
        @else
            <div class="space-y-5">
                @foreach ($reviews as $review)
                    <div class="bg-white border border-gray-200 rounded-lg p-5 shadow">
                        <div class="flex justify-between items-start mb-2">
                            <div class="flex items-start space-x-3">
                                {{-- ユーザーアイコン --}}
                                <img src="{{ $review->user->icon_url ?? asset('images/default-user-icon.png') }}"
                                     alt="{{ $review->user->name }} さんのアイコン"
                                     class="w-12 h-12 rounded-full object-cover">

                                <div>
                                    <h2 class="text-2xl font-semibold text-blue-800 leading-tight">
                                        <a href="{{ route('movies.show', $review->movie->id) }}" class="hover:underline">
                                            {{ $review->movie->title }}
                                        </a>
                                    </h2>
                                    <p class="text-sm text-gray-600 leading-tight">
                                        {{ $review->created_at->format('Y年m月d日') }} に投稿（{{ $review->user->name }} さん）
                                    </p>
                                </div>
                            </div>

                            {{-- 星評価 --}}
                            <div class="flex items-center text-yellow-400 text-base leading-none">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $review->rating)
                                        ★
                                    @else
                                        <span class="text-gray-300">★</span>
                                    @endif
                                @endfor
                                <span class="ml-2 text-yellow-600 font-semibold">{{ $review->rating }}</span>
                            </div>
                        </div>

                        {{-- レビュータイトル --}}
                        @if ($review->title)
                            <div class="text-2xl font-bold mb-1 leading-tight">{{ $review->title }}</div>
                        @endif

                        {{-- コメント --}}
                        <p class="text-gray-800 whitespace-pre-line text-lg leading-tight mb-3">
                            {{ Str::limit($review->comment, 150) ?? '（コメントなし）' }}
                        </p>

                        {{-- いいね数 --}}
                        <div class="flex justify-end mt-1">
                            <p class="text-base text-gray-500">❤️ いいね数：{{ $review->likedByUsers()->count() }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- ページネーション --}}
            <div class="mt-6">
                {{ $reviews->links() }}
            </div>
        @endif
    </div>
</x-app-layout>

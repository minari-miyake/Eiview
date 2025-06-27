<x-app-layout>
    <div class="p-6 max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold mb-6">📝 マイレビュー一覧</h1>

        @if ($reviews->isEmpty())
            <p class="text-xl text-gray-500 text-center">レビュー履歴がまだありません。</p>
        @else
            <div class="space-y-5">
                @foreach ($reviews as $review)
                    <div class="bg-white border border-gray-200 rounded-lg p-5 shadow">
                        {{-- ユーザーアイコン + タイトル + 投稿日 --}}
                        <div class="flex justify-between items-start mb-2">
                            <div class="flex items-center space-x-3">
                                <img src="{{ $review->user->icon_url ?? asset('images/default-user-icon.png') }}"
                                     alt="{{ $review->user->name }} さんのアイコン"
                                     class="w-10 h-10 rounded-full object-cover">

                                <div>
                                    <h2 class="text-2xl font-semibold text-blue-800 leading-tight">
                                        <a href="{{ route('movies.show', $review->movie->id) }}" class="hover:underline">
                                            {{ $review->movie->title }}
                                        </a>
                                    </h2>
                                    <p class="text-sm text-gray-600 leading-tight">
                                        {{ $review->created_at->format('Y年m月d日') }} に投稿
                                    </p>
                                </div>
                            </div>

                            <div>
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

                                {{-- 編集・削除ボタン（星評価の下・右寄せ） --}}
                                <div class="flex space-x-4 mt-2 text-sm justify-end">
                                    <a href="{{ route('reviews.edit', $review->id) }}"
                                       class="text-blue-600 hover:underline">
                                        編集
                                    </a>

                                    <form action="{{ route('reviews.destroy', $review->id) }}" method="POST"
                                          onsubmit="return confirm('本当に削除しますか？');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-red-600 hover:underline bg-transparent border-none p-0 m-0 cursor-pointer">
                                            削除
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- レビュータイトル --}}
                        @if ($review->title)
                            <div class="text-xl font-bold text-gray-900 mb-2">
                                {{ $review->title }}
                            </div>
                        @endif

                        {{-- コメント --}}
                        <p class="text-gray-800 whitespace-pre-line text-base leading-tight">
                            {{ $review->comment ?? '（コメントなし）' }}
                        </p>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $reviews->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
<x-app-layout>
    <div class="p-6 max-w-4xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">📝 マイレビュー一覧</h1>

        @if ($reviews->isEmpty())
            <p class="text-lg text-gray-500 text-center">レビュー履歴がまだありません。</p>
        @else
            <div class="space-y-6">
                @foreach ($reviews as $review)
                    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <h2 class="text-xl font-semibold text-blue-800">
                                    <a href="{{ route('movies.show', $review->movie->id) }}" class="hover:underline">
                                        {{ $review->movie->title }}
                                    </a>
                                </h2>
                                <p class="text-sm text-gray-600">
                                    {{ $review->created_at->format('Y年m月d日') }} に投稿
                                </p>
                            </div>
                            <div class="text-yellow-500 text-sm">
                                ★{{ $review->rating }}
                            </div>
                        </div>

                        @if ($review->title)
                            <div class="text-lg font-bold mb-1">{{ $review->title }}</div>
                        @endif

                        <p class="text-gray-800 whitespace-pre-line text-sm">
                            {{ $review->comment ?? '（コメントなし）' }}
                        </p>

                        {{-- 編集・削除ボタン --}}
                        <div class="mt-1 space-x-2">
                            <a href="{{ route('reviews.edit', $review->id) }}"
                               class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                                編集
                            </a>

                            <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" class="inline"
                                  onsubmit="return confirm('本当に削除しますか？');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-red-600 hover:text-red-800 text-sm font-medium">
                                    削除
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $reviews->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
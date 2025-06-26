<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl">❤️ いいねしたレビュー一覧</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto p-6 bg-white rounded shadow">
        @forelse ($reviews as $review)
            <div class="border-b py-4">
                <h3 class="font-semibold text-lg">{{ $review->title ?? '（タイトルなし）' }}</h3>
                <p>評価: {{ $review->rating }} ★</p>
                <p>{{ Str::limit($review->comment, 150) }}</p>
                <p>
                    映画：
                    <a href="{{ route('movies.show', $review->movie->id) }}" class="text-blue-600 hover:underline">
                        {{ $review->movie->title }}
                    </a>
                </p>
                <p>レビュー投稿者：{{ $review->user->name }}</p>
                <p>👍 いいね数：{{ $review->likedByUsers()->count() }}</p>
            </div>
        @empty
            <p>まだいいねしたレビューはありません。</p>
        @endforelse

        <div class="mt-4">
            {{ $reviews->links() }}
        </div>
    </div>
</x-app-layout>
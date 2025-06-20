<x-layouts.app>//ユーザ側映画詳細
  <div class="max-w-4xl mx-auto py-6">
    <h1 class="text-3xl font-bold mb-4">{{ $movie->title }}</h1>

    @if($movie->image_url)
      <img src="{{ asset($movie->image_url) }}" alt="{{ $movie->title }}" class="mb-4 w-full max-h-[400px] object-cover rounded">
    @endif

    <p class="mb-4 whitespace-pre-line">{{ $movie->summary }}</p>

    <h2 class="text-2xl font-semibold mt-8 mb-4">レビュー一覧</h2>
    @forelse ($movie->reviews as $review)
      <div class="mb-4 border-b pb-4">
        <div class="text-sm text-gray-600">投稿者: {{ $review->user->name ?? '匿名' }}</div>
        <div class="text-yellow-400">評価: {{ $review->rating }} / 5</div>
        <p class="mt-2 whitespace-pre-line">{{ $review->comment }}</p>
      </div>
    @empty
      <p class="text-gray-500">まだレビューがありません。</p>
    @endforelse
  </div>
</x-layouts.app>

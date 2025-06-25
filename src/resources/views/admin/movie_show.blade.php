@extends('layouts.admin')

@section('title', $movie->title . ' - 映画詳細')

@section('content')
<div class="p-6 max-w-6xl mx-auto">
    <div class="flex flex-col md:flex-row gap-6">
        {{-- 左カラム：映画画像 --}}
        <div class="md:w-1/3">
            @if ($movie->image_url)
                <img src="{{ asset($movie->image_url) }}" alt="{{ $movie->title }}" class="w-full rounded shadow object-contain max-h-[400px]">
            @else
                <div class="text-sm text-gray-500">画像が登録されていません。</div>
            @endif
        </div>

        {{-- 右カラム --}}
        <div class="md:w-2/3 flex flex-col">
            {{-- タイトル --}}
            <h1 class="text-3xl font-bold mb-4">{{ $movie->title }}</h1>

            {{-- 評価 --}}
            <div class="flex items-center space-x-2 mb-4">
                @for($i = 1; $i <= 5; $i++)
                    <svg class="w-8 h-8 {{ $i <= round($movie->averageRating()) ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.965h4.175c.969 0 1.371 1.24.588 1.81l-3.381 2.455
                                 1.287 3.965c.3.921-.755 1.688-1.539 1.118L10 13.348l-3.381 2.455
                                 c-.784.57-1.838-.197-1.539-1.118l1.287-3.965L3.018 8.702
                                 c-.783-.57-.38-1.81.588-1.81h4.175L9.049 2.927z"/>
                    </svg>
                @endfor
                <span class="text-lg font-medium text-gray-700">{{ number_format($movie->averageRating(), 1) }}</span>
            </div>

            {{-- あらすじ --}}
            <h2 class="text-lg font-semibold mb-2">あらすじ</h2>
            @if($movie->summary)
                <p class="text-sm text-gray-700 mb-4 whitespace-pre-line">{{ $movie->summary }}</p>
            @else
                <p class="text-sm text-gray-500 italic mb-4">あらすじはまだ登録されていません。</p>
            @endif

            {{-- 出演者 --}}
            <h2 class="text-lg font-semibold mb-2">出演者</h2>
            @if($movie->director)
                <p class="text-sm text-gray-700 mb-4">{{ $movie->director }}</p>
            @else
                <p class="text-sm text-gray-500 italic mb-4">出演者情報は未登録です。</p>
            @endif

            {{-- 公式サイト --}}
            <h2 class="text-lg font-semibold mb-2">公式サイト</h2>
            @if($movie->official_url)
                <a href="{{ $movie->official_url }}" target="_blank" class="text-sm text-blue-600 underline hover:text-blue-800">
                    {{ $movie->official_url }}
                </a>
            @else
                <p class="text-sm text-gray-500 italic mb-4">公式サイトは登録されていません。</p>
            @endif
        </div>
    </div>

    {{-- レビュー一覧 --}}
    <div class="mt-10">
        <h2 class="text-4xl font-bold mb-6 text-gray-800 border-b border-gray-300 pb-2">
            📝 レビュー一覧
        </h2>

        {{-- レビュー投稿フォーム --}}
        @include('reviews.form', ['movie' => $movie])

        {{-- レビューリスト --}}
        <div id="review-list" class="space-y-6 max-h-96 overflow-auto">
            @forelse ($movie->reviews->sortByDesc('created_at') as $review)
                <div class="review-item bg-white border border-gray-200 rounded-lg shadow p-6" data-review-id="{{ $review->id }}">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex items-center space-x-4">
                            <img src="{{ $review->user->icon_url ?? asset('default-icon.png') }}" alt="{{ $review->user->name }}のアイコン"
                                 class="w-14 h-14 rounded-full object-cover border border-gray-300 shadow-sm">
                            <div>
                                <div class="text-base font-bold text-gray-800">{{ $review->user->name }} さん</div>
                                <div class="flex items-center mt-1">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.965h4.175c.969 0
                                                     1.371 1.24.588 1.81l-3.381 2.455 1.287 3.965c.3.921-.755
                                                     1.688-1.539 1.118L10 13.348l-3.381 2.455c-.784.57-1.838-.197-1.539-1.118
                                                     l1.287-3.965L3.018 8.702c-.783-.57-.38-1.81.588-1.81h4.175L9.049 2.927z"/>
                                        </svg>
                                    @endfor
                                    <span class="ml-1 text-sm text-gray-700">★{{ $review->rating }}</span>
                                </div>
                            </div>
                        </div>

                        {{-- 削除ボタン（管理者用） --}}
                        <div class="text-sm text-gray-500 flex flex-col items-end">
                            <span>{{ $review->created_at->format('Y年m月d日') }}</span>

                            @if(auth()->check() && auth()->user()->is_admin)
                                <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" class="inline mt-2" onsubmit="return confirm('本当に削除しますか？');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-600 text-white text-xs font-semibold rounded shadow hover:bg-red-700 transition">
                                        削除
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>

                    {{-- レビュータイトルと本文 --}}
                    @if ($review->title)
                        <div class="text-lg font-semibold text-gray-900 mb-1 leading-tight">{{ $review->title }}</div>
                    @endif
                    <p class="text-sm text-gray-800 leading-tight whitespace-pre-line">
                        {{ $review->comment ?? '（コメントなし）' }}
                    </p>
                </div>
            @empty
                <p class="text-sm text-gray-600">レビューはまだありません。</p>
            @endforelse
        </div>
    </div>

    {{-- 戻る --}}
    <div class="mt-6 text-right">
        <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:underline">&lt; 映画一覧に戻る</a>
    </div>
</div>
@endsection
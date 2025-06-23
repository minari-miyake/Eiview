{{-- resources/views/admin/movies/show.blade.php など --}}

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
            {{-- 1. タイトル --}}
            <h1 class="text-3xl font-bold mb-4">{{ $movie->title }}</h1>

            {{-- 評価（星 + 数値） --}}
            <div class="flex items-center space-x-2 mb-4">
                @for($i = 1; $i <= 5; $i++)
                    <svg class="w-8 h-8 {{ $i <= round($movie->averageRating()) ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.965h4.175c.969 0 1.371 1.24.588 1.81l-3.381 2.455 1.287 3.965c.3.921-.755 1.688-1.539 1.118L10 13.348l-3.381 2.455c-.784.57-1.838-.197-1.539-1.118l1.287-3.965L3.018 8.702c-.783-.57-.38-1.81.588-1.81h4.175L9.049 2.927z"/>
                    </svg>
                @endfor
                <span class="text-lg font-medium text-gray-700">{{ number_format($movie->averageRating(), 1) }}</span>
            </div>

            {{-- 2. あらすじ --}}
            <h2 class="text-lg font-semibold mb-2">あらすじ</h2>
            @if($movie->summary)
                <p class="text-sm text-gray-700 mb-4 whitespace-pre-line">{{ $movie->summary }}</p>
            @else
                <p class="text-sm text-gray-500 italic mb-4">あらすじはまだ登録されていません。</p>
            @endif

            {{-- 3. 演出者（監督） --}}
            <h2 class="text-lg font-semibold mb-2">出演者</h2>
            @if($movie->director)
                <p class="text-sm text-gray-700 mb-4">{{ $movie->director }}</p>
            @else
                <p class="text-sm text-gray-500 italic mb-4">出演者情報は未登録です。</p>
            @endif

            {{-- 4. 公式サイト --}}
            <h2 class="text-lg font-semibold mb-2">公式サイト</h2>
            @if($movie->official_url)
                <a href="{{ $movie->official_url }}" target="_blank" rel="noopener noreferrer" class="text-sm text-blue-600 underline hover:text-blue-800">
                    {{ $movie->official_url }}
                </a>
            @else
                <p class="text-sm text-gray-500 italic mb-4">公式サイトは登録されていません。</p>
            @endif

            {{-- 5. レビュー一覧 --}}
            <h2 class="text-lg font-semibold mt-6 mb-3">レビュー一覧</h2>
            @if($movie->reviews->isEmpty())
                <p class="text-sm text-gray-600">レビューはまだありません。</p>
            @else
                <ul class="space-y-4 max-h-96 overflow-auto">
                    @foreach($movie->reviews as $review)
                        <li class="bg-white border rounded p-4 shadow">
                            <div class="flex items-center justify-between mb-1">
                                <span class="text-yellow-500 text-sm font-semibold">評価: {{ $review->rating }}</span>
                                <span class="text-xs text-gray-500">{{ $review->created_at->format('Y-m-d') }}</span>
                            </div>
                            <p class="text-sm text-gray-800">{{ $review->comment ?? '（コメントなし）' }}</p>
                        </li>
                    @endforeach
                </ul>
            @endif

            {{-- 戻る --}}
            <div class="mt-6 text-right">
                <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:underline">&lt; 映画一覧に戻る</a>
            </div>
        </div>
    </div>
</div>
@endsection


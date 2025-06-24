@extends('layouts.admin')
 
@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">🎦 管理者用映画一覧</h1>
 
    {{-- 検索フォーム --}}
    <div class="mb-8">
        <form method="GET" action="{{ route('admin.dashboard') }}"
              class="w-full max-w-xl mx-auto flex items-center border border-gray-300 rounded-full overflow-hidden shadow-sm focus-within:ring-2 focus-within:ring-blue-500 transition">
            <input
                type="text"
                name="keyword"
                value="{{ old('keyword', request('keyword')) }}"
                placeholder="作品名で検索"
                class="flex-grow px-5 py-3 text-gray-700 placeholder-gray-400 focus:outline-none"
            />
            <button
                type="submit"
                class="bg-white hover:bg-blue-50 px-5 py-3 text-blue-600 font-semibold text-sm border-l border-gray-300"
            >
                検索
            </button>
        </form>
    </div>
 
    {{-- 映画追加ボタン --}}
    <div class="mb-6 flex justify-end">
        <a href="{{ route('admin.movie.create') }}"
           class="inline-flex items-center space-x-2 px-6 py-3 bg-blue-600 text-white text-base font-semibold rounded-full shadow hover:bg-blue-700 transition duration-200">
            <span class="text-xl">＋</span>
            <span>映画を追加</span>
        </a>
    </div>
 
    {{-- 映画一覧 --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
        @forelse($movies as $movie)
            <div class="border rounded-lg p-4 shadow text-center bg-white">
                <a href="{{ route('admin.movie.show', $movie->id) }}">
                    <h2 class="text-lg font-semibold mb-2 h-12 overflow-hidden break-words">
                        {{ $movie->title }}
                    </h2>
                    @if ($movie->image_url)
                        <img
                            src="{{ asset($movie->image_url) }}"
                            alt="{{ $movie->title }}"
                            class="w-40 h-56 mx-auto mb-3 rounded object-contain bg-gray-50"
                        >
                    @else
                        <div class="text-sm text-gray-500">画像なし</div>
                    @endif
                </a>
 
                {{-- 星評価 --}}
                <div class="flex justify-center items-center space-x-1 mb-2">
                    @for($i = 1; $i <= 5; $i++)
                        <svg class="w-4 h-4 {{ $i <= round($movie->averageRating()) ? 'text-yellow-400' : 'text-gray-300' }}"
                             fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.965h4.175c.969 0 1.371 1.24.588 1.81l-3.381 2.455
                            1.287 3.965c.3.921-.755 1.688-1.539 1.118L10 13.348l-3.381 2.455c-.784.57-1.838-.197-1.539-1.118l1.287-3.965L3.018
                            8.702c-.783-.57-.38-1.81.588-1.81h4.175L9.049 2.927z"/>
                        </svg>
                    @endfor
                    <span class="text-sm text-gray-700 font-medium ml-1">
                        {{ number_format($movie->averageRating(), 1) }}
                    </span>
                </div>
 
                {{-- 編集・削除 --}}
                <div class="flex justify-center space-x-2 mt-2">
                    <a href="{{ route('admin.movie.edit', $movie->id) }}" class="px-3 py-1 text-sm bg-green-500 text-white rounded hover:bg-green-600">編集</a>
 
                    <form action="{{ route('admin.movie.destroy', $movie->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-3 py-1 text-sm bg-red-500 text-white rounded hover:bg-red-600">削除</button>
                    </form>
                </div>
            </div>
        @empty
            <p class="col-span-3 text-center text-gray-600">映画データはありません</p>
        @endforelse
    </div>
 
    {{-- ページネーション --}}
    <div class="mt-8">
        {{ $movies->appends(['keyword' => request('keyword')])->links() }}
    </div>
</div>
@endsection
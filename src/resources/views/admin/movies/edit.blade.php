@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-6">映画情報編集</h1>

@if ($errors->any())
    <div class="mb-4 text-red-600">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.movies.update', $movie) }}" method="POST" enctype="multipart/form-data" class="space-y-6 max-w-xl">
    @csrf
    @method('PUT')

    <div>
        <label for="title" class="block font-semibold mb-1">タイトル</label>
        <input type="text" name="title" id="title" required
            class="w-full border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-blue-200"
            value="{{ old('title', $movie->title) }}">
    </div>

    <div>
        <label for="poster_image" class="block font-semibold mb-1">ポスター画像</label>
        <input type="file" name="poster_image" id="poster_image" class="w-full border border-gray-300 rounded px-3 py-2">
        @if ($movie->poster_image)
            <img src="{{ asset('storage/' . $movie->poster_image) }}" alt="現在のポスター" class="mt-2 h-48 object-cover">
        @endif
    </div>

    <div>
        <label for="release_date" class="block font-semibold mb-1">リリース日</label>
        <input type="date" name="release_date" id="release_date"
            class="w-full border border-gray-300 rounded px-3 py-2"
            value="{{ old('release_date', $movie->release_date ? $movie->release_date->format('Y-m-d') : '') }}">
    </div>

    <div>
        <label for="details" class="block font-semibold mb-1">出演者などの詳細（任意）</label>
        <textarea name="details" id="details" rows="3"
            class="w-full border border-gray-300 rounded px-3 py-2">{{ old('details', $movie->details) }}</textarea>
    </div>

    <div>
        <label for="synopsis" class="block font-semibold mb-1">あらすじ（任意）</label>
        <textarea name="synopsis" id="synopsis" rows="4"
            class="w-full border border-gray-300 rounded px-3 py-2">{{ old('synopsis', $movie->synopsis) }}</textarea>
    </div>

    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-2 rounded">
        更新する
    </button>
</form>
@endsection

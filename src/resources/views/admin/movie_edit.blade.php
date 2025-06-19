@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">🎬 映画編集</h1>

    <form action="{{ route('admin.movie.update', $movie->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-semibold">タイトル</label>
            <input type="text" name="title" value="{{ old('title', $movie->title) }}" class="w-full border rounded p-2">
        </div>

        <div class="mb-4">
            <label class="block font-semibold">画像ファイル</label>
             <input type="file" name="image" class="w-full border rounded p-2">
        </div>

        <div class="mb-4">
            <label class="block font-semibold">概要</label>
            <textarea name="summary" rows="4" class="w-full border rounded p-2">{{ old('summary', $movie->summary) }}</textarea>
        </div>

        <label class="flex flex-col">
    <span class="font-semibold mb-1">演出者（監督）</span>
    <input type="text" name="director" value="{{ old('director', $movie->director) }}"
           class="border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
</label>

<label class="flex flex-col">
    <span class="font-semibold mb-1">公式サイトURL</span>
    <input type="url" name="official_url" value="{{ old('official_url', $movie->official_url) }}"
           class="border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
</label>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">更新</button>
    </form>
</div>
@endsection

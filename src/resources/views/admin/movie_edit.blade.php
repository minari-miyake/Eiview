@extends('layouts.admin')

@section('title', '映画編集')

@section('content')
<div class="p-6 max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">🎬 映画編集</h1>

    <form action="{{ route('admin.movie.update', $movie->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-semibold mb-1">タイトル</label>
            <input type="text" name="title" value="{{ old('title', $movie->title) }}" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block font-semibold mb-1">画像ファイル</label>
            <input type="file" name="image" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block font-semibold mb-1">概要</label>
            <textarea name="summary" rows="4" class="w-full border rounded p-2">{{ old('summary', $movie->summary) }}</textarea>
        </div>

        <div>
            <label class="block font-semibold mb-1">演出者（監督）</label>
            <input type="text" name="director" value="{{ old('director', $movie->director) }}" class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="block font-semibold mb-1">公式サイトURL</label>
            <input type="url" name="official_url" value="{{ old('official_url', $movie->official_url) }}" class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mt-4">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">更新</button>
        </div>
    </form>
</div>
@endsection

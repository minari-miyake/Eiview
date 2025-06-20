<x-layouts.app>
<div class="max-w-3xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">🎬 映画追加</h1>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.movie.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-6">
        @csrf

        <label class="flex flex-col">
            <span class="font-semibold mb-1">映画タイトル <span class="text-red-600">*</span></span>
            <input type="text" name="title" value="{{ old('title') }}" required
                   class="border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </label>

        <label class="flex flex-col">
            <span class="font-semibold mb-1">あらすじ</span>
            <textarea name="summary" rows="5" class="border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('summary') }}</textarea>
        </label>

        <label class="flex flex-col">
            <span class="font-semibold mb-1">演出者（監督）</span>
            <input type="text" name="director" value="{{ old('director') }}" class="border rounded p-2">
        </label>

        <label class="flex flex-col">
            <span class="font-semibold mb-1">公式サイトURL</span>
            <input type="url" name="official_url" value="{{ old('official_url') }}" class="border rounded p-2">
        </label>

        <label class="flex flex-col">
            <span class="font-semibold mb-1">画像アップロード</span>
            <input type="file" name="image" accept="image/*"
           class="border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </label>

        <div class="flex justify-end">
            <button type="submit"
                class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                追加
            </button>
        </div>
    </form>

    <div class="mt-4 text-right">
        <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:underline">&lt; 戻る</a>
    </div>
</div>
</x-layouts.app>

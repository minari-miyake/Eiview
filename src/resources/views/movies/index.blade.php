<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🎬 映画一覧
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- 検索フォーム --}}
            <form method="GET" action="{{ route('movies.index') }}" class="mb-6 flex flex-wrap gap-2 items-center">
                <input
                    type="text"
                    name="keyword"
                    value="{{ old('keyword', $keyword ?? '') }}"
                    placeholder="タイトルやジャンルで検索"
                    class="border border-gray-300 rounded px-4 py-2 w-full sm:w-64"
                />
                <button
                    type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded"
                >
                    検索
                </button>
            </form>

            @if($movies->isEmpty())
                <p class="text-gray-500">映画が見つかりませんでした。</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach ($movies as $movie)
                        <a href="{{ route('movies.show', $movie->id) }}"
                           class="block bg-white p-4 rounded shadow hover:shadow-md transition">

                            <h2 class="text-xl font-bold mb-2">{{ $movie->title }}</h2>

                            @if($movie->image_url)
                                <img src="{{ asset($movie->image_url) }}"
                                     alt="{{ $movie->title }}"
                                     class="h-40 object-cover w-full rounded mb-2" />
                            @else
                                <div class="h-40 bg-gray-200 flex items-center justify-center rounded mb-2">
                                    <span class="text-gray-600">画像なし</span>
                                </div>
                            @endif

                            <p class="text-sm text-gray-700">
                                {{ Str::limit($movie->summary, 100) }}
                            </p>
                        </a>
                    @endforeach
                </div>

                <div class="mt-6">
                    {{ $movies->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
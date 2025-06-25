<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-6">❤️ お気に入り映画一覧</h1>

        @if ($favoriteMovies->isEmpty())
            <p class="text-lg text-gray-500 text-center">お気に入りに登録された映画はありません。</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($favoriteMovies as $movie)
                    <div class="border rounded-lg p-4 shadow-md text-center bg-white flex flex-col justify-between h-[380px]">
                        <a href="{{ route('movies.show', $movie->id) }}">
                            <h2 class="text-lg font-semibold mb-2 h-12 overflow-hidden text-ellipsis whitespace-nowrap">
                                {{ $movie->title }}
                            </h2>
                            @if ($movie->image_url)
                                <img
                                    src="{{ asset($movie->image_url) }}"
                                    alt="{{ $movie->title }}"
                                    class="w-40 h-56 mx-auto mb-3 rounded bg-white object-contain"
                                >
                            @else
                                <div class="text-sm text-gray-500 h-56 flex items-center justify-center">画像なし</div>
                            @endif
                        </a>

                        {{-- 星評価 --}}
                        <div class="flex justify-center items-center space-x-2 mt-2">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-5 h-5 {{ $i <= round($movie->averageRating()) ? 'text-yellow-400' : 'text-gray-300' }}"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.965h4.175c.969 0 1.371 1.24.588 1.81l-3.381 2.455
                                    1.287 3.965c.3.921-.755 1.688-1.539 1.118L10 13.348l-3.381 2.455c-.784.57-1.838-.197-1.539-1.118l1.287-3.965L3.018
                                    8.702c-.783-.57-.38-1.81.588-1.81h4.175L9.049 2.927z"/>
                                </svg>
                            @endfor
                            <span class="text-gray-700 font-medium">{{ number_format($movie->averageRating(), 1) }}</span>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- ページネーション（必要なら） --}}
            {{-- <div class="mt-6 flex justify-center">
                {{ $favoriteMovies->links() }}
            </div> --}}
        @endif

        {{-- 戻る --}}
        <div class="mt-8 text-right">
            <a href="{{ route('movies.index') }}" class="text-blue-600 hover:underline">
                &lt; 映画一覧に戻る
            </a>
        </div>
    </div>
</x-app-layout>
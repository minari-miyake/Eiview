<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
    <div class="p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-gray-900">お気に入り映画</h3>
            <a href="{{ route('movies.favorites') }}" class="text-blue-500 hover:text-blue-600 text-sm font-medium">すべて見る</a>
        </div>
        
        @if(isset($favoriteMovies) && $favoriteMovies->count() > 0)
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-4">
                @foreach($favoriteMovies as $movie)
                    <div class="bg-gray-50 rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-200">
                        <!-- ポスター画像 -->
                        <div class="aspect-[2/3] bg-gray-200 relative">
                            @if($movie->poster_url ?? $movie->image_url)
                                <img src="{{ $movie->poster_url ?? $movie->image_url }}" 
                                     alt="{{ $movie->title }}" 
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2h4a1 1 0 110 2h-1v12a2 2 0 01-2 2H6a2 2 0 01-2-2V6H3a1 1 0 110-2h4z"></path>
                                    </svg>
                                </div>
                            @endif
                            
                            <!-- 評価バッジ -->
                            @if($movie->rating)
                                <div class="absolute top-2 right-2 bg-yellow-500 text-white text-xs font-bold px-2 py-1 rounded">
                                    {{ $movie->rating }}
                                </div>
                            @endif
                        </div>
                        
                        <!-- 映画情報 -->
                        <div class="p-3">
                            <h4 class="font-semibold text-gray-900 text-sm mb-1 line-clamp-2">{{ $movie->title }}</h4>
                            <p class="text-xs text-gray-600 mb-1">{{ $movie->genre ?? '' }}</p>
                            @if($movie->release_date)
                                <p class="text-xs text-gray-500">{{ $movie->release_date->format('Y年') }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-8">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
                <h4 class="mt-2 text-lg font-medium text-gray-900">お気に入り映画がありません</h4>
                <p class="mt-1 text-sm text-gray-500">気に入った映画をお気に入りに追加してみましょう！</p>
                <div class="mt-4">
                    <a href="{{ route('movies.index') }}" 
                       class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-lg transition duration-200">
                        映画を探す
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

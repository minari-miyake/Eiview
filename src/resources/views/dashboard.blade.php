<x-app-layout> 
   

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- ヒーローセクション -->
            <div class="relative bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-700 overflow-hidden shadow-2xl rounded-2xl mb-8">
                <!-- 背景パターン -->
                <div class="absolute inset-0 bg-black opacity-20"></div>
                <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.05"%3E%3Ccircle cx="30" cy="30" r="4"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
                
                <div class="relative p-8 text-white">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-3xl font-bold mb-2 bg-gradient-to-r from-white to-blue-100 bg-clip-text text-transparent">
                                こんにちは、{{ Auth::user()->name }}さん！
                            </h3>
                            <p class="text-blue-100 text-lg">Eiview で映画の魅力を発見し、感動を共有しましょう</p>
                        </div>
                    </div>
                    
                    <!-- 映画一覧セクション -->
                    <div class="mt-6">
                        <div class="flex justify-between items-center mb-4">
                            <h4 class="text-2xl font-bold text-white">🍿映画ランキングTOP5</h4>
                        </div>
                        
                        @if(isset($movies) && $movies->count() > 0)
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                                @foreach($movies as $movie)
                                    <div class="group bg-white bg-opacity-15 backdrop-blur-md rounded-xl overflow-hidden shadow-lg hover:shadow-2xl hover:bg-opacity-25 transition-all duration-300 transform hover:-translate-y-1">
                                        <!-- ポスター画像 -->
                                        <div class="aspect-[2/3] bg-black bg-opacity-30 relative overflow-hidden">
                                            @if($movie->poster_url)
                                                <img src="{{ $movie->poster_url }}" 
                                                     alt="{{ $movie->title }}" 
                                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-600 to-gray-800">
                                                    <svg class="w-12 h-12 text-white text-opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2h4a1 1 0 110 2h-1v12a2 2 0 01-2 2H6a2 2 0 01-2-2V6H3a1 1 0 110-2h4z"></path>
                                                    </svg>
                                                </div>
                                            @endif
                                            
                                            <!-- 評価バッジ -->
                                            @if($movie->rating)
                                                <div class="absolute top-3 right-3 bg-gradient-to-r from-yellow-400 to-orange-500 text-white text-xs font-bold px-2 py-1 rounded-full shadow-lg">
                                                    ⭐ {{ $movie->rating }}
                                                </div>
                                            @endif
                                            
                                            <!-- ホバーオーバーレイ -->
                                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center">
                                                <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                    <button class="bg-white bg-opacity-90 text-gray-800 px-4 py-2 rounded-full font-medium text-sm hover:bg-opacity-100 transition-all duration-200">
                                                        詳細を見る
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- 映画情報 -->
                                        <div class="p-4">
                                            <h5 class="font-bold text-white text-sm mb-2 line-clamp-2 group-hover:text-blue-100 transition-colors duration-200">{{ $movie->title }}</h5>
                                            <p class="text-xs text-blue-200 mb-1 font-medium">{{ $movie->genre }}</p>
                                            @if($movie->release_date)
                                                <p class="text-xs text-blue-300 opacity-80">{{ $movie->release_date->format('Y年') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                       @else
    <!-- 映画ランキングを表示 -->
    <div class="bg-sky-100 overflow-hidden shadow-sm sm:rounded-lg mt-6 border border-blue-400">
        <div class="p-8">

            @if(isset($topRatedMovies) && $topRatedMovies->count() > 0)
                <div class="space-y-4">
                    @foreach(array_slice($topRatedMovies->all(), 0, 5) as $index => $movie)
                        <div class="flex items-center p-4 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl hover:from-gray-100 hover:to-gray-200 transition-all duration-300">
                            <!-- ランキング番号 -->
                            <div class="flex-shrink-0 mr-4">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-white
                                    {{ $index === 0 ? 'bg-gradient-to-r from-yellow-400 to-yellow-600' : '' }}
                                    {{ $index === 1 ? 'bg-gradient-to-r from-gray-400 to-gray-600' : '' }}
                                    {{ $index === 2 ? 'bg-gradient-to-r from-orange-400 to-orange-600' : '' }}
                                    {{ $index >= 3 ? 'bg-gradient-to-r from-blue-400 to-blue-600' : '' }}">
                                    {{ $index + 1 }}
                                </div>
                            </div>

                            <!-- 映画ポスター -->
<div class="flex-shrink-0 mr-4">
    <div class="w-16 h-24 bg-gray-200 rounded-lg overflow-hidden">
        @if($movie->image_url)
            <img src="{{ asset($movie->image_url) }}" alt="{{ $movie->title }}" class="w-full h-full object-cover">
        @else
            <div class="w-full h-full flex items-center justify-center">
                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2h4a1 1 0 110 2h-1v12a2 2 0 01-2 2H6a2 2 0 01-2-2V6H3a1 1 0 110-2h4z"/>
                </svg>
            </div>
        @endif
    </div>
</div>


                            <!-- 映画情報 -->
                            <div class="flex-1">
                                <h4 class="font-bold text-xl text-gray-900 mb-1">{{ $movie->title }}</h4>
                                <p class="text-sm text-gray-600 mb-1">{{ $movie->genre }}</p>
                                @if($movie->director)
                                    <p class="text-xs text-gray-500">監督: {{ $movie->director }}</p>
                                @endif
                            </div>

                            <!-- 評価 -->
                            <div class="flex-shrink-0 text-right">
                                <div class="flex items-center space-x-2 mb-1 justify-end">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-5 h-5 {{ $i <= round($movie->averageRating()) ? 'text-yellow-400' : 'text-gray-300' }}"
                                             fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.965h4.175c.969 0 1.371 1.24.588 1.81l-3.381 2.455 1.287 3.965c.3.921-.755 1.688-1.539 1.118L10 13.348l-3.381 2.455c-.784.57-1.838-.197-1.539-1.118l1.287-3.965L3.018 8.702c-.783-.57-.38-1.81.588-1.81h4.175L9.049 2.927z"/>
                                        </svg>
                                    @endfor
                                    <span class="text-sm font-semibold text-gray-700">
                                        {{ number_format($movie->averageRating(), 1) }}
                                    </span>
                                </div>

                                @if($movie->release_date)
                                    <p class="text-xs text-gray-500">{{ $movie->release_date->format('Y年') }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6 text-center">
                    <a href="{{ route('movies.index') }}" class="inline-flex items-center bg-gradient-to-r from-yellow-500 to-orange-600 text-white px-6 py-3 rounded-xl font-medium hover:from-yellow-600 hover:to-orange-700 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        すべての映画を見る
                    </a>
                </div>
            @else
                <p class="text-gray-500 text-center">評価付き映画がまだ登録されていません。</p>
            @endif
        </div>
    </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- 統計情報 -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-all duration-300 group">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">投稿したレビュー</p>
                                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $reviewCount }}</p>
                            </div>
                            <div class="bg-gradient-to-br from-blue-400 to-blue-600 p-3 rounded-xl group-hover:scale-110 transition-transform duration-300">
                                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-all duration-300 group">
    <div class="p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">お気に入り映画</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $favoriteCount ?? 0 }}</p>
            </div>
            <div class="bg-gradient-to-br from-green-400 to-green-600 p-3 rounded-xl group-hover:scale-110 transition-transform duration-300">
                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
            </div>
        </div>
    </div>
</div>


                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-all duration-300 group">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">平均評価</p>
                                <p class="text-3xl font-bold text-gray-900 mt-2">-</p>
                                <p class="text-xs text-gray-500 mt-1">レビュー待ち</p>
                            </div>
                            <div class="bg-gradient-to-br from-yellow-400 to-orange-500 p-3 rounded-xl group-hover:scale-110 transition-transform duration-300">
                                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- クイックアクション -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="bg-gradient-to-r from-blue-500 to-purple-600 w-1 h-6 rounded-full mr-3"></span>
                        クイックアクション
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <a href="{{ route('movies.index') }}" class="group bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-xl hover:from-blue-100 hover:to-blue-200 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg border border-blue-200">
                            <div class="flex items-center justify-between mb-3">
                                <div class="bg-blue-500 p-3 rounded-xl group-hover:scale-110 transition-transform duration-300">
                                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <svg class="h-5 w-5 text-blue-400 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                            <h4 class="text-blue-900 font-bold text-lg mb-1">映画を検索</h4>
                            <p class="text-blue-700 text-sm">お気に入りの映画を見つけよう</p>
                        </a>
                        
                        <a href="{{ route('profile.show') }}" class="group bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-xl hover:from-green-100 hover:to-green-200 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg border border-green-200">
                            <div class="flex items-center justify-between mb-3">
                                <div class="bg-green-500 p-3 rounded-xl group-hover:scale-110 transition-transform duration-300">
                                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <svg class="h-5 w-5 text-green-400 group-hover:text-green-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                            <h4 class="text-green-900 font-bold text-lg mb-1">プロフィール</h4>
                            <p class="text-green-700 text-sm">あなたの情報を確認・編集</p>
                        </a>
                        
                        <a href="{{ route('movies.favorites') }}" class="group bg-gradient-to-br from-purple-50 to-purple-100 p-6 rounded-xl hover:from-purple-100 hover:to-purple-200 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg border border-purple-200">
                            <div class="flex items-center justify-between mb-3">
                                <div class="bg-purple-500 p-3 rounded-xl group-hover:scale-110 transition-transform duration-300">
                                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </div>
                                <svg class="h-5 w-5 text-purple-400 group-hover:text-purple-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                            <h4 class="text-purple-900 font-bold text-lg mb-1">お気に入り一覧</h4>
                            <p class="text-purple-700 text-sm">お気に入りの映画を確認</p>
                        </a>
                    </div>
                </div>
            </div>
                               
</x-app-layout>

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
                    
                </div>
            </div>

            <!-- 統計情報 -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-all duration-300 group">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">投稿したレビュー</p>
                                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $reviewCount ?? 0 }}</p>
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
                                <p class="text-3xl font-bold text-gray-900 mt-2">
                                    @if(isset($averageRating) && $averageRating > 0)
                                        {{ number_format($averageRating, 1) }}
                                    @else
                                        -
                                    @endif
                                </p>
                                <p class="text-xs text-gray-500 mt-1">
                                    @if(isset($averageRating) && $averageRating > 0)
                                        5点満点中
                                    @else
                                        レビュー待ち
                                    @endif
                                </p>
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
                            <h4 class="text-blue-900 font-bold text-lg mb-1">映画一覧へ</h4>
                            <p class="text-blue-700 text-sm">お気に入りの映画を見つけよう！</p>
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
                            <h4 class="text-purple-900 font-bold text-lg mb-1">お気に入り映画一覧</h4>
                            <p class="text-purple-700 text-sm">お気に入りの映画を確認しよう</p>
                        </a>
                    </div>
                </div>
            </div>
                               
</x-app-layout>

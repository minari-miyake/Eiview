<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('プロフィール') }}
            </h2>
            <a href="{{ route('profile.edit') }}" 
               class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
                編集
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- プロフィール情報カード -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex flex-col md:flex-row items-center md:items-start space-y-4 md:space-y-0 md:space-x-6">
                        <!-- プロフィール画像 -->
                        <div class="flex-shrink-0">
                            @if($user->icon_url)
                                <img src="{{ asset($user->icon_url) }}" 
                                     alt="プロフィール画像" 
                                     class="w-32 h-32 rounded-full object-cover border-4 border-gray-200 shadow-lg">
                            @else
                                <div class="w-32 h-32 rounded-full bg-gray-300 flex items-center justify-center border-4 border-gray-200 shadow-lg">
                                    <svg class="w-16 h-16 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- ユーザー情報 -->
                        <div class="flex-1 text-center md:text-left">
                            <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $user->name }}</h1>
                            <p class="text-gray-600 mb-4">{{ $user->email }}</p>
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <!-- 年齢 -->
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-4 8a4 4 0 11-8 0v-1a4 4 0 014-4h4a4 4 0 014 4v1a4 4 0 11-8 0z"></path>
                                        </svg>
                                        <span class="text-sm font-medium text-gray-500">年齢</span>
                                    </div>
                                    <p class="text-lg font-semibold text-gray-900 mt-1">
                                        {{ $user->age ? $user->age . '歳' : '未設定' }}
                                    </p>
                                </div>

                                <!-- 性別 -->
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-purple-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        <span class="text-sm font-medium text-gray-500">性別</span>
                                    </div>
                                    <p class="text-lg font-semibold text-gray-900 mt-1">
                                        @switch($user->gender)
                                            @case('male')男性 @break
                                            @case('female')女性 @break
                                            @case('other')その他 @break
                                            @default 未設定
                                        @endswitch
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 統計情報（仮） -->
            @include('profile.partials.statistics')

            <!-- 最近のレビュー -->
            @include('profile.partials.recent-reviews')

            <!-- お気に入り映画 -->
            @include('profile.partials.favorite-movies')
        </div>
    </div>
</x-app-layout>

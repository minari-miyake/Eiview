<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center items-center 
                bg-gradient-to-br from-blue-300 via-cyan-200 to-teal-200 
                px-4 sm:px-6 md:px-10 lg:px-20 xl:px-24 py-10">

        <div class="w-full max-w-lg mx-auto text-center">

            <!-- ロゴ（日本語表記） -->
            <h1 class="text-[clamp(3rem,8vw,6rem)] font-black tracking-tight text-blue-900 drop-shadow-xl mb-3 select-none">
                Eiview
            </h1>

            <!-- キャッチコピー -->
            <h2 class="text-[clamp(1.5rem,4vw,2.5rem)] font-semibold text-blue-800 mb-6 leading-tight">
                映画レビューを、もっとスマートに。
            </h2>

            <!-- ログインフォーム -->
            <div class="w-full bg-white rounded-2xl shadow-xl px-6 py-6 text-left">
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- メールアドレス -->
                    <div class="mb-4">
                        <x-input-label for="email" :value="'メールアドレス'" />
                        <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" class="w-full mt-1" />
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    <!-- パスワード -->
                    <div class="mb-4">
                        <x-input-label for="password" :value="'パスワード'" />
                        <x-text-input id="password" type="password" name="password" required autocomplete="current-password" class="w-full mt-1" />
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                    <!-- ログイン状態を保持 -->
                    <div class="flex items-center mb-4">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                        <label for="remember_me" class="ms-2 text-sm text-gray-700">
                            ログイン状態を保持する
                        </label>
                    </div>

                    <!-- アクション -->
                    <div class="flex items-center justify-between">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">
                                パスワードをお忘れですか？
                            </a>
                        @endif

                        <x-primary-button class="ml-3 bg-blue-500 hover:bg-blue-600">
                            ログイン
                        </x-primary-button>
                    </div>
                </form>
            </div>

            <!-- 登録リンク -->
            <div class="mt-6 text-sm text-gray-800">
                アカウントをお持ちでないですか？
                <a href="{{ route('register') }}" class="text-blue-700 hover:underline font-medium">新規登録はこちら</a>
            </div>
        </div>
    </div>
</x-guest-layout>

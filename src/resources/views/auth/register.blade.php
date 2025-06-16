<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center items-center 
                bg-gradient-to-br from-blue-300 via-cyan-200 to-teal-200 
                px-4 sm:px-6 md:px-10 lg:px-20 xl:px-24 py-10">

        <div class="w-full max-w-lg mx-auto text-center">

            <!-- ロゴ -->
            <h1 class="text-[clamp(3rem,8vw,6rem)] font-black tracking-tight text-blue-900 drop-shadow-xl mb-3 select-none">
                Eiview
            </h1>

            <!-- キャッチコピー -->
            <h2 class="text-[clamp(1.5rem,4vw,2.5rem)] font-semibold text-blue-800 mb-6 leading-tight">
                映画レビューを、もっとスマートに。
            </h2>

            <!-- 登録フォーム -->
            <div class="w-full bg-white rounded-2xl shadow-xl px-6 py-6 text-left">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- 名前 -->
                    <div class="mb-4">
                        <x-input-label for="name" :value="'名前'" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- メールアドレス -->
                    <div class="mb-4">
                        <x-input-label for="email" :value="'メールアドレス'" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- パスワード -->
                    <div class="mb-4">
                        <x-input-label for="password" :value="'パスワード'" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- パスワード確認 -->
                    <div class="mb-4">
                        <x-input-label for="password_confirmation" :value="'パスワード（確認）'" />
                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <!-- アクション -->
                    <div class="flex items-center justify-between">
                        <a class="text-sm text-blue-600 hover:underline" href="{{ route('login') }}">
                            すでに登録済みの方はこちら
                        </a>

                        <x-primary-button class="ml-3 bg-blue-500 hover:bg-blue-600">
                            登録する
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>

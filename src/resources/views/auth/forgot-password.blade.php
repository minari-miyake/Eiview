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
                パスワード再設定
            </h2>

            <!-- 説明 -->
            <div class="mb-6 text-base sm:text-lg text-gray-700">
                パスワードをお忘れですか？<br class="sm:hidden">
                ご登録のメールアドレスを入力していただければ、<br>
                パスワード再設定用のリンクをお送りします。
            </div>

            <!-- フォーム -->
            <div class="w-full bg-white rounded-2xl shadow-xl px-6 py-6 text-left">
                
                <!-- ステータスメッセージ -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- メールアドレス -->
                    <div class="mb-4">
                        <x-input-label for="email" :value="'メールアドレス'" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- ボタン -->
                    <div class="flex items-center justify-end">
                        <x-primary-button class="bg-blue-500 hover:bg-blue-600">
                            パスワード再設定リンクを送信
                        </x-primary-button>
                    </div>
                </form>
            </div>

            <!-- ログインに戻る -->
            <div class="mt-6 text-sm text-gray-800">
                <a href="{{ route('login') }}" class="text-blue-700 hover:underline font-medium">
                    ログイン画面に戻る
                </a>
            </div>

        </div>
    </div>
</x-guest-layout>

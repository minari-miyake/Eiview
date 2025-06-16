<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center items-center 
                bg-gradient-to-br from-blue-300 via-cyan-200 to-teal-200 
                px-4 sm:px-6 md:px-10 lg:px-20 xl:px-24 py-10">

        <div class="w-full max-w-md mx-auto text-center select-none mb-8">
            <h1 class="text-[clamp(3rem,8vw,6rem)] font-black tracking-tight text-blue-900 drop-shadow-xl">
                Eiview
            </h1>
        </div>

        <div class="w-full max-w-md mx-auto bg-white rounded-2xl shadow-xl px-8 py-8 text-left">
            
            <h2 class="text-center text-5xl font-extrabold text-blue-900 mb-8">
                管理者ログイン
            </h2>

            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf

                <div class="mb-6">
                    <x-input-label for="email" value="メールアドレス" />
                    <x-text-input id="email" name="email" type="email" class="block mt-1 w-full" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mb-6">
                    <x-input-label for="password" value="パスワード" />
                    <x-text-input id="password" name="password" type="password" class="block mt-1 w-full" required />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex justify-end">
                    <x-primary-button>
                        ログイン
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>

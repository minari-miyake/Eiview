<section>
    <div class="bg-white p-8 rounded-lg shadow-lg">
        <header class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">プロフィール編集</h2>
            <p class="mt-2 text-sm text-gray-600">
                アカウント情報（メールアドレス・年齢・性別）を更新できます。
            </p>
        </header>

        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('patch')

            <div class="mb-6 flex flex-col items-center">
                <label for="icon" class="block text-lg font-medium text-gray-700 mb-2">プロフィールアイコン</label>
                <div class="relative">
                    <img id="icon-preview" src="{{ $user->icon_url ?? '/default-icon.png' }}" class="w-32 h-32 rounded-full border-4 border-gray-300 shadow-lg">
                    <label for="icon" class="absolute bottom-0 right-0 bg-indigo-600 text-white rounded-full w-8 h-8 flex items-center justify-center cursor-pointer hover:bg-indigo-700">+</label>
                    <input id="icon" name="icon" type="file" class="hidden" onchange="document.getElementById('icon-preview').src = window.URL.createObjectURL(this.files[0])">
                </div>
                @error('icon')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="name" class="block text-lg font-medium text-gray-700">名前</label>
                <input id="name" name="name" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-lg font-medium text-gray-700">メールアドレス</label>
                <input id="email" name="email" type="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ old('email', $user->email) }}" required autocomplete="username">
                @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-4">
                        <p class="text-sm text-gray-800">
                            メールアドレスが未確認です。
                            <button form="send-verification" class="underline text-sm text-indigo-600 hover:text-indigo-800">
                                再確認メールを送信する
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 text-sm text-green-600">
                                新しい確認リンクをメールアドレスに送信しました。
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            <div class="mb-4">
                <label for="age" class="block text-lg font-medium text-gray-700">年齢</label>
                <input id="age" name="age" type="number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ old('age', $user->age) }}" required autocomplete="age">
                @error('age')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="gender" class="block text-lg font-medium text-gray-700">性別</label>
                <select id="gender" name="gender" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="male" {{ old('gender', $user->gender) === 'male' ? 'selected' : '' }}>男性</option>
                    <option value="female" {{ old('gender', $user->gender) === 'female' ? 'selected' : '' }}>女性</option>
                    <option value="other" {{ old('gender', $user->gender) === 'other' ? 'selected' : '' }}>その他</option>
                </select>
                @error('gender')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-4">
                <button type="submit" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    保存する
                </button>

                @if (session('status') === 'profile-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600"
                    >保存しました。</p>
                @endif
            </div>
        </form>
    </div>
</section>


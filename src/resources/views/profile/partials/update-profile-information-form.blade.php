<section class="min-h-screen bg-gradient-to-r from-purple-400 via-pink-500 to-red-500 flex items-center justify-center">
    <div class="bg-white p-10 rounded-3xl shadow-2xl transform transition duration-500 hover:scale-105 w-full max-w-4xl">
        <header class="mb-6 text-center">
            <h2 class="text-4xl font-extrabold text-gray-800 font-serif">
                {{ __('Edit Profile') }}
            </h2>

            <p class="mt-2 text-lg text-gray-600 font-light">
                {{ __("Update your account's profile information and Email address, Age, Gender.") }}
            </p>
        </header>

        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('patch')

            <div class="mb-6 flex flex-col items-center">
                <label for="icon" class="block text-lg font-medium text-gray-700 mb-2">{{ __('Profile Icon') }}</label>
                <div class="relative">
                    <img id="icon-preview" src="{{ $user->icon_url ?? '/default-icon.png' }}"  class="w-32 h-32 rounded-full border-4 border-gray-300 shadow-lg">
                    <label for="icon" class="absolute bottom-0 right-0 bg-indigo-600 text-white rounded-full w-8 h-8 flex items-center justify-center cursor-pointer hover:bg-indigo-700">
                        +
                    </label>
                    <input id="icon" name="icon" type="file" class="hidden" onchange="document.getElementById('icon-preview').src = window.URL.createObjectURL(this.files[0])">
                </div>
                @error('icon')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="name" class="block text-lg font-medium text-gray-700">{{ __('Name') }}</label>
                <input id="name" name="name" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-lg font-medium text-gray-700">{{ __('Email') }}</label>
                <input id="email" name="email" type="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ old('email', $user->email) }}" required autocomplete="username">
                @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-4">
                        <p class="text-sm text-gray-800">
                            {{ __('Your email address is unverified.') }}

                            <button form="send-verification" class="underline text-sm text-indigo-600 hover:text-indigo-800">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 text-sm text-green-600">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            <div class="mb-4">
                <label for="age" class="block text-lg font-medium text-gray-700">{{ __('Age') }}</label>
                <input id="age" name="age" type="number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ old('age', $user->age) }}" required autocomplete="age">
                @error('age')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="gender" class="block text-lg font-medium text-gray-700">{{ __('Gender') }}</label>
                <select id="gender" name="gender" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="male" {{ old('gender', $user->gender) === 'male' ? 'selected' : '' }}>{{ __('Male') }}</option>
                    <option value="female" {{ old('gender', $user->gender) === 'female' ? 'selected' : '' }}>{{ __('Female') }}</option>
                    <option value="other" {{ old('gender', $user->gender) === 'other' ? 'selected' : '' }}>{{ __('Other') }}</option>
                </select>
                @error('gender')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-4">
                <button type="submit" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    {{ __('Save') }}
                </button>

                @if (session('status') === 'profile-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600"
                    >{{ __('Saved.') }}</p>
                @endif
            </div>
        </form>
    </div>
</section>

<nav class="bg-white border-b border-gray-200 shadow">
  <div class="max-w-7xl mx-auto px-8 flex items-center justify-between h-24">
    
    <!-- 左：ロゴとナビリンク -->
    <div class="flex items-center space-x-12">
      <!-- ロゴ -->
      <a href="{{ route('dashboard') }}" class="text-3xl font-extrabold text-blue-800 hover:text-blue-600 transition duration-300">
        Eiview
      </a>

      <!-- ナビリンク -->
      <a href="{{ route('dashboard') }}"
         class="relative inline-block text-sm font-semibold px-6 py-2 rounded-xl bg-gradient-to-tr from-blue-100 to-blue-50
                text-blue-800 shadow-md border border-blue-200 hover:from-blue-200 hover:to-blue-100 hover:text-blue-900
                transition duration-300 ease-in-out transform hover:-translate-y-0.5 active:translate-y-0">
        ダッシュボード
      </a>

      <a href="{{ route('movies.index') }}"
         class="relative inline-block text-sm font-semibold px-6 py-2 rounded-xl bg-gradient-to-tr from-blue-100 to-blue-50
                text-blue-800 shadow-md border border-blue-200 hover:from-blue-200 hover:to-blue-100 hover:text-blue-900
                transition duration-300 ease-in-out transform hover:-translate-y-0.5 active:translate-y-0">
        映画一覧
      </a>

      <a href="{{ route('movies.favorites') }}"
         class="relative inline-block text-sm font-semibold px-6 py-2 rounded-xl bg-gradient-to-tr from-blue-100 to-blue-50
                text-blue-800 shadow-md border border-blue-200 hover:from-blue-200 hover:to-blue-100 hover:text-blue-900
                transition duration-300 ease-in-out transform hover:-translate-y-0.5 active:translate-y-0">
        お気に入り映画
      </a>

      <a href="{{ route('my.reviews') }}"
          class="relative inline-block text-sm font-semibold px-6 py-2 rounded-xl bg-gradient-to-tr from-blue-100 to-blue-50
                text-blue-800 shadow-md border border-blue-200 hover:from-blue-200 hover:to-blue-100 hover:text-blue-900
                transition duration-300 ease-in-out transform hover:-translate-y-0.5 active:translate-y-0">
        マイレビュー一覧
      </a>
    </div>

    <!-- 右：ユーザードロップダウン -->
    <x-dropdown align="right" width="48">
      <x-slot name="trigger">
        <button class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:text-gray-900 transition duration-300 ease-in-out">
          <span>{{ Auth::user()->name }}</span>
          <svg class="ms-2 h-5 w-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
          </svg>
        </button>
      </x-slot>

      <x-slot name="content">
        <x-dropdown-link :href="route('profile.show')">プロフィール</x-dropdown-link>
        <x-dropdown-link :href="route('profile.edit')">プロフィール編集</x-dropdown-link>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
            ログアウト
          </x-dropdown-link>
        </form>
      </x-slot>
    </x-dropdown>

  </div>
</nav>
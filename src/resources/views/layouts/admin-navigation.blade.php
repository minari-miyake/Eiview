<nav class="bg-gray-800 text-white shadow">
  <div class="max-w-7xl mx-auto px-8 flex items-center justify-between h-24">
    <!-- 左：ロゴとナビ項目 -->
    <div class="flex items-center space-x-8">
      <!-- ロゴ -->
      <a href="{{ route('admin.dashboard') }}" class="text-2xl font-bold hover:text-gray-300 transition">
        🎩 Admin
      </a>

      <!-- ナビリンク（ボタン風に） -->
      <a href="{{ route('admin.dashboard') }}"
         class="text-sm font-semibold px-4 py-2 bg-gray-700 rounded-md shadow-sm hover:bg-gray-600 transition
                border border-gray-600 hover:border-gray-400">
        管理者映画一覧
      </a>
    </div>

    <!-- 右：ログアウト -->
    <form method="POST" action="{{ route('admin.logout') }}">
      @csrf
      <button type="submit"
              class="px-5 py-2 bg-red-500 hover:bg-red-600 rounded-md text-sm font-medium shadow-sm
                     transition border border-red-600 hover:border-red-400">
        ログアウト
      </button>
    </form>
  </div>
</nav>



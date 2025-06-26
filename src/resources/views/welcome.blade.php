<!DOCTYPE html> {{-- ユーザ側のスタートサイト --}}
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Eiview - 映画館レビュー</title>
  
  <!-- Favicon -->
  <link rel="icon" type="image/jpeg" href="{{ asset('eiview_logo.jpg') }}">
  <link rel="shortcut icon" type="image/jpeg" href="{{ asset('eiview_logo.jpg') }}">
  <link rel="apple-touch-icon" href="{{ asset('eiview_logo.jpg') }}">
  
  @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 text-gray-800 font-sans">

  <!-- 管理者ログイン：右上配置 -->
  <div class="absolute top-4 right-6 z-50 flex items-center space-x-3 bg-gradient-to-r from-red-800 via-red-900 to-black text-white px-5 py-2 rounded-full shadow-lg">
    <span class="text-sm font-semibold tracking-wide">管理者ログインはこちらから</span>
    <a href="{{ route('admin.login') }}"
       class="bg-red-700 hover:bg-red-800 text-white text-xs font-bold py-1.5 px-4 rounded-full transition duration-200 border border-red-900 shadow-md">
      管理者ログイン
    </a>
  </div>

  <!-- ヒーローセクション -->
  <section class="min-h-screen flex flex-col justify-center items-center 
                 bg-gradient-to-br from-blue-300 via-cyan-200 to-teal-200 
                 text-center px-6 sm:px-10 md:px-20 lg:px-40 py-20 shadow-lg">

    <h1 class="text-[clamp(3rem,8vw,6rem)] font-black tracking-tight text-blue-900 drop-shadow-xl mb-4 select-none">
      Eiview
    </h1>

    <h2 class="text-[clamp(1.5rem,4vw,2.5rem)] font-semibold text-blue-800 mb-6 leading-tight">
      映画レビューを、もっとスマートに。
    </h2>

    <p class="max-w-2xl text-base sm:text-lg md:text-xl leading-relaxed text-gray-700 mb-10 px-4">
      映画を見た体験や感想をシェアしませんか？<br>
      <span class="font-semibold">Eiview</span> は映画好きのためのレビュー共有アプリです。<br>
      あなたの思い出を語り合い、感動をもっと広げましょう。
    </p>
    
    <div class="flex flex-wrap justify-center gap-6">
      <a href="{{ route('register') }}">
        <button class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 px-8 rounded-full shadow-md transition duration-200 hover:scale-105">
          新規登録
        </button>
      </a>
      <a href="{{ route('login') }}">
        <button class="bg-teal-500 hover:bg-teal-600 text-white font-semibold py-3 px-8 rounded-full shadow-md transition duration-200 hover:scale-105">
          ログイン
        </button>
      </a>
    </div>
  </section>
 
  <!-- フッター -->
  <footer class="mt-16 bg-gray-200 text-gray-600 py-6 text-center text-sm select-none">
    <p>&copy; 2025 Eiview. All rights reserved.</p>
  </footer>
 
</body>
</html>

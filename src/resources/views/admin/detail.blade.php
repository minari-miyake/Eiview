<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>映画詳細</title>
  @vite(['resources/css/admin.css', 'resources/js/admin.js'])  {{-- 管理者CSS/JSを読み込み --}}
</head>
<body class="bg-gray-100 text-gray-800 p-6">
  <div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">映画詳細ページ</h1>

    <div id="movie-detail" class="bg-white p-4 rounded shadow">
      <p class="text-gray-600">※詳細内容はここに表示されます。</p>
    </div>
  </div>
</body>
</html>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eiview - 映画館レビュー</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <!-- Hero セクション -->
    <section class="text-center py-16 bg-gradient-to-r from-indigo-500 to-purple-600 text-white bg-cover bg-center" style="background-image: url('cinema_screen01-300x200.png');">
        <h1 class="text-4xl font-bold mb-4">映画館レビューを、もっと楽しく。</h1>
        <p class="text-lg mb-6">あなたの映画体験をシェアしよう！</p>

        <div class="flex justify-center space-x-4">
            <a href="/register">
                <button class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded">
                    新規登録
                </button>
            </a>
            <a href="/login">
                <button class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
                    ログイン
                </button>
            </a>
        </div>
    </section>

    <!-- 検索フォーム -->
    <section class="max-w-4xl mx-auto mt-10 px-4">
        <form method="GET" action="/search" class="flex gap-4">
            <input type="text" name="query" placeholder="映画館名・地域で検索"
                   class="w-full p-3 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-400">
            <button type="submit"
                    class="bg-indigo-600 text-white px-6 py-3 rounded hover:bg-indigo-700">検索</button>
        </form>
    </section>

    <!-- フッター -->
    <footer class="mt-20 bg-gray-800 text-white py-6 text-center">
        <p>&copy; 2025 Eiview. All rights reserved.</p>
    </footer>

</body>
</html>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>管理者ページ - Eiview</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="{{ asset('eiview_logo.jpg') }}">
    <link rel="shortcut icon" type="image/jpeg" href="{{ asset('eiview_logo.jpg') }}">
    <link rel="apple-touch-icon" href="{{ asset('eiview_logo.jpg') }}">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">
    @include('layouts.admin-navigation')

    <main class="max-w-7xl mx-auto mt-6 px-4">
        @yield('content')
    </main>
</body>
</html>

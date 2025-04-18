<!-- resources/views/layouts/base.blade.php -->

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? '講義システム' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) {{-- Tailwindなど --}}
</head>
<body class="bg-gray-100 text-gray-800 font-sans">
    <header class="bg-white shadow p-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">{{ $title ?? '講義システム' }}</h1>
            <nav class="space-x-4">
                <a href="{{ route('dashboard') }}" class="text-blue-600 hover:underline">ホーム</a>
                <a href="{{ route('profile.edit') }}" class="text-blue-600 hover:underline">プロフィール</a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button class="text-red-500 hover:underline">ログアウト</button>
                </form>
            </nav>
        </div>
    </header>

    <main class="max-w-5xl mx-auto py-8 px-4">
        @yield('content')
    </main>
</body>
</html>

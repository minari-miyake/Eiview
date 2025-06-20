<x-admin.layouts.app>
    <x-slot name="title">映画一覧</x-slot>

    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-6">映画一覧</h1>

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-4 py-2">ID</th>
                    <th class="border px-4 py-2">タイトル</th>
                    <th class="border px-4 py-2">公開日</th>
                    <th class="border px-4 py-2">操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($movies as $movie)
                    <tr class="hover:bg-gray-50">
                        <td class="border px-4 py-2 text-center">{{ $movie->id }}</td>
                        <td class="border px-4 py-2">{{ $movie->title }}</td>
                        <td class="border px-4 py-2 text-center">{{ $movie->release_date }}</td>
                        <td class="border px-4 py-2 text-center">
                            <a href="{{ route('admin.movies.edit', $movie->id) }}" class="text-blue-600 hover:underline">編集</a>
                            <form action="{{ route('admin.movies.destroy', $movie->id) }}" method="POST" class="inline-block" onsubmit="return confirm('本当に削除しますか？');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline ml-2">削除</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $movies->links() }} {{-- ページネーション --}}
        </div>
    </div>
</x-admin.layouts.app>

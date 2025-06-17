@extends('layouts.app')

@section('content')
<div class="p-6">
  <h1 class="text-2xl font-bold mb-6">🎬 映画一覧（管理画面）</h1>

  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
    @foreach ($movies as $movie)
    <div class="bg-white rounded shadow p-4">
      <h2 class="font-bold text-lg mb-2">{{ $movie->title }}</h2>
      <a href="{{ route('dashboard.detail', $movie->id) }}">
        <img src="{{ $movie->image }}" alt="{{ $movie->title }}" class="rounded mb-2">
      </a>
      <p class="text-yellow-500">
        {{ str_repeat('★', round($movie->average_rating)) }}
        {{ str_repeat('☆', 5 - round($movie->average_rating)) }}
        <span class="text-sm text-gray-600">({{ $movie->average_rating }})</span>
      </p>
    </div>
    @endforeach
  </div>

  <div class="mt-6">
    {{ $movies->links() }}
  </div>
</div>
@endsection

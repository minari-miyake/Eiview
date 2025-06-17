@extends('layouts.app')

@section('content')
<div class="p-6">
  <h1 class="text-xl font-bold mb-4">{{ $movie->title }}</h1>

  <img src="{{ $movie->image }}" class="w-full max-w-xs mb-4 rounded" alt="{{ $movie->title }}">

  <p class="text-yellow-500">
    {{ str_repeat('★', round($movie->average_rating)) }}
    {{ str_repeat('☆', 5 - round($movie->average_rating)) }}
    <span class="text-sm text-gray-600">({{ $movie->average_rating }})</span>
  </p>

  <p class="mt-4 text-gray-700">この映画の詳細情報がここに入ります。</p>
</div>
@endsection

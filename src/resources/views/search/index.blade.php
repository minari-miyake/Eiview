<!-- resources/views/search/index.blade.php -->

@extends('layouts.app')  <!-- もし共通レイアウトがあれば -->

@section('content')
    <h1>検索ページ</h1>
    <p>検索キーワード: {{ $keyword }}</p>
@endsection
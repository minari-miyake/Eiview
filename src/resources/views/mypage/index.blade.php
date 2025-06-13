@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $user->name }} さんのマイページ</h2>
    <ul>
        <li>メールアドレス：{{ $user->email }}</li>
        <li>登録日：{{ $user->created_at->format('Y年m月d日') }}</li>
    </ul>
</div>
@endsection
<!-- 『layouts.login』ファイルに引継ぐ指定 -->
@extends('layouts.login')

<!-- 引継ぐ範囲指定/開始 -->
@section('content')

@foreach($posts as $post)

<!-- フォローされているユーザーが登録しているアイコン表示/クリックするとユーザー毎にプロフィール画面を表示 -->
<p>{{ $post->posts }}</p>

<!-- 繰り返し処理範囲指定/終了 -->
@endforeach

<!-- 引継ぐ範囲指定/終了 -->
@endsection

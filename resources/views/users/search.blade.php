<!-- ユーザー検索フォーム -->


<!-- 『layouts.login』ファイルに引継ぐ指定 -->
@extends('layouts.login')

<!-- 引継ぐ範囲指定/開始 -->
@section('content')

<!-- ユーザー検索表示範囲指定/開始 -->
<div class="search_form">
  <!-- form範囲指定/開始/post送信/送信先：/search -->
  <form action="/search" method="post">
    <!-- トークン作成/他サイトへのセキュリティ対策 -->
    @csrf

    <!-- ユーザー検索入力範囲指定/開始 -->
    <div class="search_wrapper">
      <!-- ユーザー名入力欄/解説：placeholderは未入力時に映る文字を設定する -->
      <input class="search_input_text" type="text" name="keyword" placeholder="ユーザー名">
      <!-- ユーザー検索ボタン作成 -->
      <input class="search_btn" type="image" src="storage/images/post.png">
      <!-- 検索ワードをテキスト表示/postsコントローラのsearchメソッドからkeywordを引継いで表示 -->
      <p class="search_keyword">検索ワード：{{ $keyword }}</p>
    </div>
  </form>
</div>

<!-- 繰り返し処理範囲指定/開始 -->
@foreach($user_list as $user)

<!-- ユーザー一覧表示範囲指定/開始 -->
<div class="search_user_list">
  <!-- left範囲指定/開始 -->
  <div class="search_left">
    <!-- ログインしてるユーザーではないのユーザーの登録しているアイコンを表示 -->
    <a class="search_icon" href="/otherProfile/{{ $user->id }}"><img class="icon" src="storage/images/{{ $user->images }}"></a>
    <!-- ログインしてるユーザーではないユーザーの名前を表示/usersコントローラのsearchメソッドからusernameを引継いで表示 -->
    <p class="search_username">{{ $user->username }}</p>
  </div>

  <!-- right範囲指定/開始 -->
  <div class="search_right">

    <!-- $followingsの配列が繰り返し処理で回ってfollowが$user->idと一致するか判定する -->
    @if(in_array($user->id,array_column($followings,'follow')))

    <!-- フォローはずすと表示 -->
    <a class="search_remove" href="/unFollow/{{ $user->id }}">フォローはずす</a><br>

    <!-- 一致しない場合の処理 -->
    @else

    <!-- フォローすると表示 -->
    <a class="search_get" href="/follow/{{ $user->id }}">フォローする</a><br>

    <!-- if文終了 -->
    @endif

  </div>
</div>

<!-- 繰り返し処理範囲指定/終了 -->
@endforeach

<!-- 引継ぐ範囲指定/終了 -->
@endsection

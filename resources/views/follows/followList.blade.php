<!-- フォローリストフォーム -->


<!-- 『layouts.login』ファイルに引継ぐ指定 -->
@extends('layouts.login')

<!-- 引継ぐ範囲指定/開始 -->
@section('content')

<!-- TOP範囲指定/開始 -->
<div class='follows_icon_lists'>
  <!-- タイトルテキスト表示 -->
  <h1 class="follows_list_text">Follow List</h1>
  <!-- アイコンリスト範囲指定/開始 -->
  <div class="follows_icon_list">

    <!-- 繰り返し処理範囲指定/開始 -->
    @foreach($user_icons as $icon)

    <!-- フォローしているユーザーが登録しているアイコン表示/クリックするとユーザー毎にプロフィール画面を表示 -->
    <a href="otherProfile/{{$icon->id}}"><img class='icon icon_lists' src="storage/images/{{ $icon->images }}"></a>

    <!-- 繰り返し処理範囲指定/終了 -->
    @endforeach

  </div>
</div>

<!-- 繰り返し処理範囲指定/開始 -->
@foreach($users as $user)

<!-- row範囲指定/開始 -->
<div class="post_list">
  <!-- left範囲指定/開始 -->
  <div class="left_post">
    <!-- フォローしているユーザーが登録しているアイコン表示/クリックするとユーザー毎にプロフィール画面を表示 -->
    <a href="/otherProfile/{{ $user->id }}"><img class='icon' src="storage/images/{{ $user->images }}"></a>
  </div>
  <!-- right範囲指定/開始 -->
  <div class="right_post">
    <!-- right_top範囲指定/開始 -->
    <div class="right_top">
      <!-- username範囲指定/開始 -->
      <div class="username list_username">
        <!-- ログインしてるユーザーではないユーザーの名前を表示/followsコントローラのfollowメソッドからusernameを引継いで表示 -->
        <p>{{ $user->username }}</p><br>
      </div>
      <!-- 投稿日範囲指定/開始 -->
      <div class="date">
        <!-- 投稿日テキスト表示/followsコントローラのfollowメソッドからcreated_atを引継いで表示 -->
        <p>{{ $user->created_at }}</p><br>
      </div>
    </div>
    <!-- posts範囲指定/開始 -->
    <div class="posts">
      <!-- postテキスト表示/followsコントローラのfollowメソッドからpostsを引継いで表示 -->
      <p>{{ $user->posts }}</p><br>
    </div>

    <!-- $followingsの配列が繰り返し処理で回ってfollowが$user->idと一致するか判定する -->
    @if(in_array($user->id,array_column($followings,'follow')))

    <!-- right_bottom範囲指定/開始 -->
    <div class="right_bottom">
      <!-- フォローはずすと表示 -->
      <p class="btn_text"><a class="follows_remove" href="/unFollow/{{ $user->id }}">フォローはずす</a></p><br>

      <!-- 一致しない場合の処理 -->
      @else

      <!-- フォローすると表示する -->
      <p class="btn_text"><a class="follows_get" href="/follow/{{ $user->id }}">フォローする</a></p><br>
    </div>

    <!-- if文終了 -->
    @endif

  </div>
</div>
</div>

<!-- 繰り返し処理範囲指定/終了 -->
@endforeach

<!-- 引継ぐ範囲指定/終了 -->
@endsection

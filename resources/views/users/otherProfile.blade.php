<!-- プロフィール確認フォーム -->


<!-- 『layouts.login』ファイルに引継ぐ指定 -->
@extends('layouts.login')

<!-- 引継ぐ範囲指定/開始 -->
@section('content')

<!-- プロフィール範囲指定/開始 -->
<div class='otherProfile_user'>
  <!-- TOP範囲指定/開始 -->
  <div class="otherProfile_wrapper">
    <!-- left範囲指定/開始 -->
    <div class="left_icon">
      <!-- 選択したユーザーの登録しているアイコンを表示 -->
      <img class="icon" src="../storage/images/{{ $user->images }}">
    </div>
    <!-- right範囲指定/開始 -->
    <div class="right_text">
      <!-- right_top範囲指定/開始 -->
      <div class="otherProfile_right_top">
        <!-- 名前欄タイトルテキスト表示 -->
        <p>Name</p>
        <!-- 選択したユーザー名を表示する -->
        <p class="otherProfile_username">{{ $user->username }}</p>
      </div>
      <!-- right_bottom範囲指定/開始 -->
      <div class="otherProfile_right_bottom">
        <!-- 自己紹介欄タイトルテキスト表示 -->
        <p class="otherProfile_bio_title">Bio</p>
        <!-- 選択したユーザーの自己紹介を表示する -->
        <p class="otherProfile_bio">{{ $user->bio }}</p>

        <!-- follows_btn範囲指定/開始 -->
        <div class="otherProfile_follow">

          <!-- $followingsの配列が繰り返し処理で回ってfollowが$user->idと一致するか判定する -->
          @if(in_array($user->id,array_column($followings,'follow')))

          <!-- フォローはずすと表示 -->
          <a class="search_remove" href="/unFollow/{{ $user->id }}">フォローはずす</a>

          <!-- 一致しない場合の処理 -->
          @else

          <!-- フォローすると表示する -->
          <a class="search_get" href="/follow/{{ $user->id }}">フォローする</a>

          <!-- if文終了 -->
          @endif

        </div>
      </div>
    </div>
  </div>

  <!-- 繰り返し処理範囲指定/開始 -->
  @foreach($posts as $post)

  <!-- 投稿一覧表示範囲指定/開始 -->
  <div class='otherProfile_post_list'>
    <!-- left範囲指定/開始 -->
    <div class="left_post">
      <!-- 投稿したユーザーが登録しているアイコンを表示 -->
      <img class="icon" src="../storage/images/{{ $post->images }}">
    </div>
    <!-- right範囲指定/開始 -->
    <div class="right_post">
      <!-- right_top範囲指定/開始 -->
      <div class="otherProfile_post_right_top">
        <!-- 投稿したユーザー名をテキスト表示/postsコントローラのotherProfileメソッドからusernameを引継いで表示 -->
        <p class="otherProfile_post_username">{{ $post->username }}</p>
        <!-- 投稿した日付をテキスト表示/postsコントローラのotherProfileメソッドからcreated_atを引継いで表示 -->
        <p class="otherProfile_post_date">{{ $post->created_at }}</p>
      </div>
      <!-- 投稿した内容の範囲指定/開始 -->
      <div class="posts">
        <!-- 投稿した内容をテキスト表示/postsコントローラのotherProfileメソッドからcreated_atを引継いで表示 -->
        <p class="otherProfile_post_posts">{{ $post->posts }}</p>
      </div>
    </div>
  </div>

  <!-- 繰り返し処理範囲指定/終了 -->
  @endforeach

</div>

<!-- 引継ぐ範囲指定/終了 -->
@endsection

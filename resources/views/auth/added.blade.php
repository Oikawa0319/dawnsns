<!-- 新規ユーザー登録完了フォーム● -->


<!-- 『layouts.logout』ファイルに引継ぐ指定 -->
@extends('layouts.logout')

<!-- 引継ぐ範囲指定/開始 -->
@section('content')

<!-- addedロゴ範囲/開始 -->
<div class="added_top">
  <!-- ロゴ表示 -->
  <h1 class='add_logo'><img src="/storage/images/main_logo.png"></h1><!-- ログアウト画面のロゴ表示 -->
</div>

<!-- addedメイン範囲指定/開始 -->
<div class="add_main">
  <!-- ログインしているユーザー名をテキスト表示する。/registerコントローラのregisterメソッドからusernameを引継いで表示 -->
  <p class='add_name'>{{ $username }}さん</p>
  <!-- テキスト表示する -->
  <p class='add_text1'>ようこそ！DAWNSNSへ！</p>
  <!-- テキスト表示する -->
  <p class='add_text2'>ユーザー登録が完了しました。</p>
  <!-- テキスト表示する -->
  <p class='add_text3'>さっそく、ログインをしてみましょう。</p>

  <!-- ボタン範囲/開始 -->
  <div class='add_logout_btn'>
    <!-- ログイン画面に戻るボタン作成 -->
    <a class='add_logout_btn_text' href="/login">ログイン画面へ</a>
  </div>
</div>

<!-- 引継ぐ範囲指定/終了 -->
@endsection

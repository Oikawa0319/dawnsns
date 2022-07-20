<!-- ログイン前画面フォーム -->


<!-- 『layouts.logout』ファイルに引継ぐ指定 -->
@extends('layouts.logout')

<!-- 引継ぐ範囲指定/開始 -->
@section('content')

<!-- ログイン前画面のヘッター範囲指定/開始 -->
<header class='logout_header'>
  <!-- DAWNロゴ表示 -->
  <h1 class='logout_logo'><img src="/storage/images/main_logo.png"></h1>
  <!-- タイトルテキスト表示 -->
  <p class='logout_title'>Social Network Service</p>
</header>

<!-- ログイン前画面のメイン範囲指定/開始 -->
<div class='logout_main'>
  <!-- form範囲指定/開始/post送信/送信先：/login -->
  <form method="POST" action="/login">
    <!-- トークン作成/他サイトへのセキュリティ対策 -->
    @csrf

    <!-- メインタイトルテキスト表示 -->
    <p class='logout_subtitle'>DAWNSNSへようこそ</p><br>

    <!-- メイン入力範囲/開始 -->
    <div class='input_container'>
      <!-- アドレス入力タイトルテキスト表示 -->
      <label class="address_label">Mail Address</label>
      <!-- アドレス入力欄 -->
      <input class="input_logout" name="mail" type="text">
      <!-- パスワード入力タイトルテキスト表示 -->
      <label class="password_label">Password</label>
      <!-- パスワード入力欄 -->
      <input class="input_logout" name="password" type="password">
    </div>

    <!-- ボタン範囲/開始 -->
    <div class='btn_container'>
      <!-- ログインボタン作成 -->
      <input class="login_btn" type="submit" value="LOGIN">
      <!-- 新規登録ボタン作成 -->
      <a class='new_register' href="/register">新規ユーザーの方はこちら</a><!-- 新規登録ユーザーページへのリンク作成し「/register」へ移動する● -->
    </div>
  </form>
</div>

<!-- 引継ぐ範囲指定/終了 -->
@endsection

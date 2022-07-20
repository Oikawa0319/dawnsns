<!-- 新規ユーザー登録フォーム -->


<!-- 『layouts.logout』ファイルに引継ぐ指定 -->
@extends('layouts.logout')

<!-- 引継ぐ範囲指定/開始 -->
@section('content')

<!-- registerロゴ範囲/開始 -->
<div class="register_top">
    <!-- ロゴ表示 -->
    <h1 class='register_logo'><img src="/storage/images/main_logo.png"></h1>
</div>

<!-- registerメイン範囲指定/開始 -->
<div class='register_main'>

    <!-- form範囲指定/開始/post送信/送信先：/register -->
    <form action="/register" method="post">
        <!-- トークン作成/他サイトへのセキュリティ対策 -->
        @csrf

        <!-- メインタイトルテキスト表示 -->
        <h2 class='new_user_register'>新規ユーザー登録</h2><!-- タイトル● -->

        <!-- ユーザー名入力範囲/開始 -->
        <div class="register_username_container">
            <!-- username入力欄タイトルテキスト表示 -->
            <label class="username_register">UserName</label>
            <!-- username入力欄 -->
            <input class="input_username_register" name="username" type="text">
            <!-- $errorsのusernameにバリデーションエラーがあるか判定する。 -->
            @if($errors->has('username'))
            <!-- usernameのバリデーションエラー範囲指定 -->
            <div class='validate_username'>
                <!-- $errorsのusernameの最初の値を表示する。 -->
                <p>{{ $errors->first('username') }}</p>
            </div>
            <!-- if文終わり -->
            @endif
        </div>

        <!-- メール入力範囲/開始 -->
        <div class="register_mail_container">
            <!-- mail入力欄タイトルテキスト表示 -->
            <label class="mail_register">MailAdress</label>
            <!-- mail入力欄 -->
            <input class="input_mail_register" name="mail" type="text">
            <!-- $errorsのmailにバリデーションエラーがあるか判定する。 -->
            @if($errors->has('mail'))
            <!-- mailのバリデーションエラー範囲指定 -->
            <div class='validate_mail'>
                <!-- $errorsのmailの最初の値を表示する。 -->
                <p>{{ $errors->first('mail') }}</p>
            </div>
            <!-- if文終わり -->
            @endif
        </div>

        <!-- パスワード入力範囲/開始 -->
        <div class="register_password_container">
            <!-- password入力欄タイトルテキスト表示 -->
            <label class='password_register'>Password</label>
            <!-- password入力欄 -->
            <input class="input_password_register" name="password" type="text">
            <!-- $errorsのpasswordにバリデーションエラーがあるか判定する。 -->
            @if($errors->has('password'))
            <!-- passwordのバリデーションエラー範囲指定 -->
            <div class='validate_password'>
                <!-- $errorsのpasswordの最初の値を表示する。 -->
                <p>{{ $errors->first('password') }}</p>
            </div>
            <!-- if文終わり -->
            @endif
        </div>

        <!-- パスワード確認用入力範囲/開始 -->
        <div class="register_passwordconfirm_container">
            <!-- passwordconfirm入力欄タイトルテキスト表示 -->
            <label class='passwordconfirm_register'>PasswordConfirm</label>
            <!-- passwordconfirm入力欄 -->
            <input class="input_passwordcofirm_register" name="password_confirmation" type="text">
            <!-- $errorsのpasswordconfirmにバリデーションエラーがあるか判定する。 -->
            @if($errors->has('password_confirmation'))
            <!-- passwordconfirmのバリデーションエラー範囲指定 -->
            <div class='validate_passwordconfirm'>
                <!-- $errorsのpasswordconfirmの最初の値を表示する。 -->
                <p>{{ $errors->first('password_confirmation') }}</p><!-- password_confirmationにエラーの値がある場合、最初の値を取得し表示する● -->
            </div>
            <!-- if文終わり -->
            @endif
        </div>

        <!-- ボタン範囲/開始 -->
        <div class="register_btn_container">
            <!-- REGISTERボタン作成 -->
            <input class="register_btn" type="submit" value="REGISTER">
            <!-- ログイン画面に戻るボタン作成 -->
            <a class='logout_back_btn' href="/login">ログイン画面へ戻る</a>
        </div>

    </form>
</div>

<!-- 引継ぐ範囲指定/終了 -->
@endsection

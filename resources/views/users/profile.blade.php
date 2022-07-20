<!-- プロフィール編集フォーム -->

<!-- 『layouts.login』ファイルに引継ぐ指定 -->
@extends('layouts.login')

<!-- 引継ぐ範囲指定/開始 -->
@section('content')

<!-- form範囲指定/開始/post送信/送信先：/profile/解説：enctype="multipart/form-data"を指定しない場合、添付ファイルの情報を送信できていない -->
<form method="POST" action="/profile" enctype="multipart/form-data">

    <!-- トークン作成/他サイトへのセキュリティ対策 -->
    @csrf

    <!-- プロフィール範囲指定/開始 -->
    <div class="profile_container">
        <!-- left範囲指定/開始 -->
        <div class="left_wrapper">
            <!-- ログインしているユーザーの登録しているアイコンを表示 -->
            <img class="profile_icon icon" src="storage/images/{{ $user->images }}">
        </div>
        <!-- right範囲指定/開始 -->
        <div class="right_wrapper">
            <!-- 名前範囲指定/開始 -->
            <div class="profile_name">
                <!-- username入力欄タイトルテキスト表示 -->
                <label class="profile_text">UserName</label>
                <!-- username入力欄/解説：valueでログインしてるユーザーの既に登録してる名前を初期値にする -->
                <input class="profile_name_input profile_input" name="username" type="text" value="{{ $user->username }}">
            </div>
            <br>

            <!-- バリデーションエラーの値があるか判定する -->
            @if($errors->has('username'))
            <!-- バリデーションエラーのテキスト表示範囲指定/開始 -->
            <div>
                <!-- バリデーションエラーの最初の値を取得して表示する -->
                <p>{{ $errors->first('username') }}</p>
            </div>

            <!-- if文終了 -->
            @endif

            <!-- メール範囲指定/開始 -->
            <div class="profile_mail">
                <!-- mail入力欄タイトルテキスト表示 -->
                <label class="profile_text">MailAdress</label>
                <!-- mail入力欄/解説：valueでログインしてるユーザーの既に登録してるmailを初期値にする -->
                <input class="profile_mail_input profile_input" name="mail" type="email" value="{{ $user->mail }}">
            </div>
            <br>

            <!-- バリデーションエラーの値があるか判定する -->
            @if($errors->has('mail'))

            <!-- バリデーションエラーのテキスト表示範囲指定/開始 -->
            <div>
                <!-- バリデーションエラーの最初の値を取得して表示する -->
                <p>{{ $errors->first('mail') }}</p><!-- mailにバリデーションエラーの値がある場合、最初の値を取得し表示する● -->
            </div>

            <!-- if文終了 -->
            @endif

            <!-- パスワード範囲指定/開始 -->
            <div class="profile_password">
                <!-- password入力欄タイトルテキスト表示 -->
                <label class="profile_text">Password</label>
                <!-- password入力欄/解説：valueでログインしてるユーザーの既に登録してるpasswordを初期値にする -->
                <input class="profile_password_input profile_input" name="password" type="password" value="{{ $user->password }}">
            </div>
            <br>

            <!-- 新パスワード範囲指定/開始 -->
            <div class="profile_newpassword">
                <!-- newpassword入力欄タイトルテキスト表示 -->
                <label class="profile_text">NewPassword</label>
                <!-- password入力欄 -->
                <input class="profile_newpassword_input profile_input" name="newpassword" type="password">
            </div>
            <br>

            <!-- バリデーションエラーの値があるか判定する -->
            @if($errors->has('password'))

            <!-- バリデーションエラーのテキスト表示範囲指定/開始 -->
            <div>
                <!-- バリデーションエラーの最初の値を取得して表示する -->
                <p>{{ $errors->first('password') }}</p><!-- passwordにバリデーションエラーの値がある場合、最初の値を取得し表示する● -->
            </div>

            <!-- if文終了 -->
            @endif

            <!-- 自己紹介範囲指定/開始 -->
            <div class="profile_bio">
                <!-- bio入力欄タイトルテキスト表示 -->
                <label class="profile_text">Bio</label>
                <!-- bio入力欄/解説：valueでログインしてるユーザーの既に登録してるbioを初期値にする -->
                <input class="profile_bio_input profile_input" type="text" name="bio" value="{{ $user->bio }}">
            </div>
            <br>

            <!-- バリデーションエラーの値があるか判定する -->
            @if($errors->has('bio'))

            <!-- バリデーションエラーのテキスト表示範囲指定/開始 -->
            <div>
                <!-- バリデーションエラーの最初の値を取得して表示する -->
                <p>{{ $errors->first('bio') }}</p><!-- bioにバリデーションエラーの値がある場合、最初の値を取得し表示する● -->
            </div>

            <!-- if文終了 -->
            @endif

            <!-- ユーザーアイコン範囲指定/開始 -->
            <div class="profile_image">
                <!-- IconImage選択欄タイトルテキスト表示 -->
                <label class="profile_text">IconImage</label>
                <!-- IconImage選択欄/解説：type="file"にすることでファイル選択欄が表示される -->
                <input class="profile_image_input profile_input" type="file" name="images">
            </div>
            <br>

            <!-- 更新ボタン範囲指定/開始 -->
            <div class="profile_btn">
                <!-- 更新ボタン作成 -->
                <input class="profile_btn_input" type="submit" value="更新">
            </div>

        </div>
    </div>
</form>

<!-- 引継ぐ範囲指定/終了 -->
@endsection

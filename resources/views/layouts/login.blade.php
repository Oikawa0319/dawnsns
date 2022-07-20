<!-- ログイン後画面に引継ぐ-->

<!DOCTYPE html>
<html>

<head>
    <!-- 文字化け対策 -->
    <meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- サイト概要説明内容表示 -->
    <meta name="description" content="ページの内容を表す文章" />
    <title>DAWN SNS login</title>
    <!-- リセットCSSの適用 -->
    <link rel="stylesheet" href="{{ asset('css/reset.css')}}">
    <!-- style.CSS適用 -->
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
    <!--スマホ,タブレットで最適にコンテンツを表示するように適用-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />

    <!-- サイトのアイコン指定/ファビコンといいHPのアイコン/今回は使用していない -->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定/モバイル端末でホーム画面に追加したときに表示されるアイコン/今回は使用していない-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
</head>

<body>

    <header>
        <!-- ログイン後画面のヘッター範囲指定/開始 -->
        <div class="head">
            <!-- ヘッター左範囲指定/開始 -->
            <div class="header_left">
                <!-- ヘッターロゴ表示 -->
                <a href="/top"><img class="header_logo" src="{{asset('storage/images/main_logo.png')}}"></a>
            </div>
            <!-- ヘッター右範囲指定/開始 -->
            <div class="header_right">
                <!-- ヘッターusername範囲指定/開始 -->
                <div class="header_user">
                    <!-- ログインしているユーザー名をテキスト表示する。/各コントローラからusernameを引継いで表示。 -->
                    <p class="header_user_text">{{ $auth->username }} さん</p>
                </div>
                <!-- ヘッタートリガーの範囲指定/開始 -->
                <div class="menu_trigger">
                    <!-- 要素を作成/CSSにてトリガーの形を作成する。 -->
                    <span></span>
                </div>
                <!-- ヘッターのアイコン範囲指定/開始 -->
                <div class="heater_icon">
                    <!-- ログインしているユーザーの登録しているアイコンを表示。 -->
                    <img class="header_icon icon" src="{{asset('storage/images/'.$auth->images)}}">
                </div>
            </div>
        </div>
    </header>


    <!-- ログイン後画面ヘッターメニュー内容範囲指定/開始 -->
    <div class="menu_box">
        <!-- メニュー内容をリスト化範囲指定/開始 -->
        <ul>
            <!-- ホーム戻るボタン作成 -->
            <li><a class="header_menu text1" href="/top">ホーム</a></li>
            <!-- プロフィール編集ボタン作成 -->
            <li><a class="header_menu text2" href="/profile">プロフィール</a></li>
            <!-- ログアウトボタン作成 -->
            <li><a class="header_menu text3" href="/logout">ログアウト</a></li>
        </ul>
    </div>

    <!-- row範囲指定/開始 -->
    <div id="row">

        <!-- container範囲指定/開始 -->
        <div id="container">
            <!-- 別ファイルのcontentを引継いで表示 -->
            @yield('content')
        </div>

        <!-- サイドバー表示範囲指定/開始 -->
        <div id="side-bar">

            <!-- TOP範囲指定/開始 -->
            <div id="confirm">
                <!-- ログインしているユーザー名をテキスト表示する。/postコントローラの各メソッドからusernameを引継いで表示。 -->
                <p class="side-bar_username">{{ $auth->username }}さんの</p>

                <!-- フォロー数表示範囲指定/開始 -->
                <div class="side-bar_follow">
                    <!-- フォロー数タイトルテキスト表示 -->
                    <p class="side-bar_follow_text">フォロー数</p>
                    <!-- フォロー数表示/各メソッドからfollowCountを引継いで表示 -->
                    <p class="side-bar_follow_Count">{{ $followCount }}名</p>
                </div>

                <!-- フォローリストボタン範囲指定/開始 -->
                <div class="side-bar_follow_btn">
                    <!-- フォローリストボタン作成 -->
                    <p class="btn_text"><a href="/followList">フォローリスト</a></p>
                </div>

                <!-- フォロワー数表示範囲指定/開始 -->
                <div class="side-bar_follower">
                    <!-- フォロワー数タイトルテキスト表示 -->
                    <p class="side-bar_follower_text">フォロワー数</p>
                    <!-- フォロー数表示/各メソッドからfollowerCountを引継いで表示 -->
                    <p class="side-bar_follower_Count">{{ $followerCount }}名</p>
                </div>

                <!-- フォロワーリストボタン範囲指定/開始 -->
                <div class="side-bar_follower_btn">
                    <!-- フォロワーリストボタン作成 -->
                    <p class="btn_text"><a href="/followerList">フォロワーリスト</a></p>
                </div>
            </div>

            <!-- サイドバー真ん中のライン範囲指定/開始 -->
            <div class="side-bar_line">
                <!-- 要素を作成/CSSにて横線を作成する。 -->
                <span></span>
            </div>

            <!-- BOTTOM範囲指定/開始 -->
            <div class="side-bar_user_search">
                <!-- ユーザー検索ボタン作成 -->
                <p class="btn_text"><a href="/search">ユーザー検索</a></p>
            </div>
        </div>
    </div>

    <!-- jQueryサイトを使用してライブラリを直接読み込み/使用する宣言 -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- jQueryを使用するファイルを指定 -->
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>

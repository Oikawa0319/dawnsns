<!-- ログアウトフォーム/『login』,『register』,『added』ファイルのテンプレ -->

<!DOCTYPE html>
<html>

<head>
    <!-- 文字化け対策 -->
    <meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- サイトのタイトル名表示 -->
    <title>DOWN SNS</title>
    <!-- サイト概要説明内容表示 -->
    <meta name="description" content="ページの内容を表す文章" />
    <!-- リセットCSSの適用 -->
    <link rel="stylesheet" href="{{ asset('css/reset.css')}}">
    <!-- ログアウトCSS適用 -->
    <link rel="stylesheet" href="{{ asset('css/logout.css')}}">
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
    <!-- contentをここに引継ぎして表示 -->
    @yield('content')
</body>

</html>

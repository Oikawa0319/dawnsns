<!-- ログイン後のTOPフォーム -->


<!-- 『layouts.login』ファイルに引継ぐ指定 -->
@extends('layouts.login')

<!-- 引継ぐ範囲指定/開始 -->
@section('content')

<!-- 投稿する範囲指定/開始 -->
<div class="post_input">
  <!-- ログインしているユーザーの登録しているアイコンを表示 -->
  <img class="icon input_icon" src="{{asset('storage/images/'.$auth->images)}}">
  <!-- form範囲指定/開始/post送信/送信先：/createTop -->
  <form action="/createTop" method="post">
    <!-- トークン作成/他サイトへのセキュリティ対策 -->
    @csrf
    <!-- 投稿入力欄/解説：placeholderは未入力時に映る文字を設定する -->
    <input class="input_text" type="text" name="post" placeholder="何をつぶやこうか...?">
    <!-- 投稿ボタン作成 -->
    <input class="input_image" type="image" src="/storage/images/post.png">
  </form>
</div>

<!-- 繰り返し処理範囲指定/開始 -->
@foreach($posts_list as $post)

<!-- 投稿一覧表示範囲指定/開始 -->
<div class="post_list">
  <!-- left範囲指定/開始 -->
  <div class="left_post">
    <!-- 投稿したユーザーが登録しているアイコンを表示 -->
    <img class="icon list_icon" src="storage/images/{{ $post->images }}">
  </div>
  <!-- right範囲指定/開始 -->
  <div class="right_post">
    <!-- right_top範囲指定/開始 -->
    <div class="right_top">
      <!-- 投稿したユーザー名範囲指定/開始 -->
      <div class="username list_username">
        <!-- 投稿したユーザー名をテキスト表示/postsコントローラのindexメソッドからusernameを引継いで表示 -->
        <p>{{ $post->username }}</p>
      </div>
      <!-- 投稿日付範囲指定/開始 -->
      <div class="date">
        <!-- 投稿した日付をテキスト表示/postsコントローラのindexメソッドからcreated_atを引継いで表示 -->
        <p>{{ $post->created_at }}</p>
      </div>
    </div>
    <!-- 投稿した内容の範囲指定/開始 -->
    <div class="posts">
      <!-- 投稿した内容をテキスト表示/postsコントローラのindexメソッドからcreated_atを引継いで表示 -->
      <p>{{ $post->posts }}</p>
    </div>

    <!-- ログインしてるユーザーidと投稿してるuser_idが一致してる場合下記を表示する -->
    @if(Auth::id() == $post->user_id)

    <!-- right_bottom範囲指定/開始 -->
    <div class="right_bottom">
      <!-- 投稿内容編集範囲指定/指定 -->
      <div class="update">
        <!-- 投稿内容編集ボタン作成 -->
        <a class="update_btn" data-target="{{ $post->id }}"><img src="/storage/images/edit.png"></a>
      </div>
      <!-- 投稿内容削除範囲指定/開始 -->
      <div class="delete">
        <!-- 投稿内容削除ボタン作成/解説：onclickでクリックした際にイベントを発生させる/解説：confirmでポップアップ表示して「はい」「いいえ」の選択を表示 -->
        <a href="post/{{$post->id}}/delete"><img src="/storage/images/trash_h.png" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')"></a>
      </div>
    </div>
    <!-- if文終了 -->
    @endif
  </div>
</div>


<!-- 投稿内容編集モーダル表示範囲指定/開始/posts.idをidに指定 -->
<div class="update_modal js-modal" id="{{ $post->id }}">
  <!-- form範囲指定/開始/post送信/送信先：/update -->
  <form action="/update" method="post">
    <!-- トークン作成/他サイトへのセキュリティ対策 -->
    @csrf

    <!-- 投稿内容編集入力範囲指定/開始 -->
    <div class="update_open">
      <!-- 投稿内容入力欄/解説：valueは初期値で既に登録してある投稿を表示してある -->
      <input class="update_input" type="text" name="update" value="{{$post->posts}}">
      <!-- 非表示で投稿idを取得 -->
      <input type="hidden" name="post_id" value="{{$post->id}}">
      <!-- 投稿変更ボタン作成 -->
      <input class="modal_update_btn" type="image" src="/storage/images/edit.png">
      <!-- TOPに戻るボタン作成 -->
      <a href="/top"><img class="modal_Close" src="/storage/images/close.png" alt=""></a>
    </div>
  </form>
</div>

<!-- 繰り返し処理範囲指定/終了 -->
@endforeach

<!-- 引継ぐ範囲指定/終了 -->
@endsection

@extends('layouts.logout')

@section('content')

{!! Form::open() !!}

<h2>新規ユーザー登録</h2>

<div>
{{ Form::label('ユーザー名') }}
<label for="">ユーザー名</label>
{{ Form::text('username',null,['class' => 'input']) }}

@if($errors->has('username'))
    <div>
        <p>{{ $errors->first('username') }}</p>
    </div>
@endif

</div>

<div>
{{ Form::label('メールアドレス') }}
<label for="">メールアドレス</label>
{{ Form::text('mail',null,['class' => 'input']) }}

@if($errors->has('mail'))
    <div>
        <p>{{ $errors->first('mail') }}</p>
    </div>
@endif

</div>

<div>
{{ Form::label('パスワード') }}
<label for="">パスワード</label>
{{ Form::text('password',null,['class' => 'input']) }}

@if($errors->has('password'))
    <div>
        <p>{{ $errors->first('password') }}</p>
    </div>
@endif

</div>

<div>
{{ Form::label('パスワード確認') }}
<label for="">パスワード確認</label>
{{ Form::text('password_confirmation',null,['class' => 'input']) }}

@if($errors->has('password_confirmation'))
    <div>
        <p>{{ $errors->first('password_confirmation') }}</p>
    </div>
@endif

</div>

{{ Form::submit('登録') }}

<p><a href="/login">ログイン画面へ戻る</a></p>

{!! Form::close() !!}


@endsection

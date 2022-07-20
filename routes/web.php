<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();




// ログアウト中のページ

// ログイン前画面フォーム
Route::get('login', 'Auth\LoginController@login');
// ログイン前画面post送信後
Route::post('/login', 'Auth\LoginController@login');


// 新規ユーザー登録フォーム
Route::get('/register', 'Auth\RegisterController@register');
// 新規ユーザー登録post送信後
Route::post('/register', 'Auth\RegisterController@register');


// 新規ユーザー登録完了画面フォーム
Route::get('/added', 'Auth\RegisterController@added');



//ログイン中のページ

// ログイン後画面TOPフォーム
Route::get('/top', 'PostsController@index');
// 投稿post送信後
Route::post('createTop', 'PostsController@createTop');
// 投稿編集post送信後
Route::post('update', 'PostsController@update');
// 投稿削除post送信後
Route::get('post/{id}/delete', 'PostsController@delete');


// ユーザー検索フォーム
Route::get('/search', 'UsersController@search');
// ユーザー検索post送信後
Route::post('/search', 'UsersController@search');


// フォロー登録
Route::get('/follow/{id}', 'FollowsController@follow');
// フォロー削除
Route::get('/unFollow/{id}', 'FollowsController@unFollow');

// フォローリストフォーム
Route::get('/followList', 'FollowsController@followList');
Route::get('/followerList', 'FollowsController@followerList'); //フォロワーリスト表示機能


// プロフィール編集フォーム
Route::get('/profile', 'UsersController@profileForm');
// プロフィールpost送信後
Route::post('/profile', 'UsersController@profile');


// プロフィール確認フォーム
Route::get('/otherProfile/{id}', 'UsersController@otherProfile');


// ログアウト処理
Route::get('/logout', 'Auth\LoginController@logout');

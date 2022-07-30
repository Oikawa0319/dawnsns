<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; //DBを追加する
use Auth; //Authを追加する


class PostsController extends Controller
{
    //indexメソッド
    // 『/top』URLにアクセスされたら実行される。

    public function index()
    {
        // ログインしているユーザー情報を全て取得して$auth変数に代入する
        $auth = Auth::user();

        // followsのDBテーブルに接続して$follow_id変数に代入する
        $follow_id = DB::table('follows')
            // followerカラムをログインしているユーザーIDに絞る
            ->where('follower', Auth::id())
            // followカラムのIDを取得する
            ->pluck('follow');

        // postsのDBテーブルに接続して$posts_list変数に代入する
        $posts_list = DB::table('posts')
            // usersのDBテーブルと連結/usersテーブルのidカラムとpostsのDBテーブルのuser_idカラムを紐付け
            ->join('users', 'users.id', '=', 'posts.user_id')
            // usersテーブルのidカラムを$follow_idに絞る/ログインしているユーザーがフォローしているidに絞っている/解説：whereInはもしくはと条件を付ける
            ->whereIn('users.id', $follow_id)
            // usersテーブルのidカラムをログインしているユーザーidに絞る/解説：orwhereはもしくはと条件を付ける
            ->orwhere('users.id', Auth::id())
            // 表示させるカラムを選択する
            ->select('users.images', 'users.username', 'posts.posts', 'posts.created_at', 'posts.updated_at', 'posts.user_id', 'posts.id')
            // posts.created_atの表示する順番を降順に並び替えする
            ->orderby('posts.created_at', 'desc')
            // 全て取得する
            ->get();

        // followsのDBテーブルに接続して$followCount変数に代入する
        $followCount = DB::table('follows')
            // followerカラムをログインしているユーザーidに絞る
            ->where('follower', Auth::id())
            // カラム数をカウントする
            ->count();

        // followsのDBテーブルに接続して $followerCount変数に代入する
        $followerCount = DB::table('follows')
            // followカラムをログインしているユーザーidに絞る
            ->where('follow', Auth::id())
            // カラム数をカウントする
            ->count();
        // 『posts.index』ファイルを表示する/ 解説：compactメソッドは引数を表示先ファイルに引継ぐ処理
        return view('posts.index', compact('posts_list', 'auth', 'followCount', 'followerCount'));
    }


    //createTopメソッド
    //『/top』URLで投稿ボタンを押したら実行される。

    //『index.blade』からPOST送信された値を引数の$requestで受け取る
    public function createTop(Request $request)
    {
        // $requestのpostの値を取得して$post変数に代入する/解説：inputは値を取得する
        $post = $request->input("post");
        // postsのDBテーブルに接続して登録/解説：insertはDBにデータを登録する
        DB::table('posts')->insert([
            // postsカラムに$postを登録する
            'posts' => $post,
            // user_idレコードにログインしているユーザーidを登録する
            'user_id' => Auth::id(),
            // created_atカラムに現在日時を楼録する
            'created_at' => now(),
        ]);
        // 『/top』URLにアクセスする
        return redirect('/top');
    }


    //updateメソッド
    //『/top』URLで投稿編集ボタンを押したら実行される。

    //『index.blade』からPOST送信された値を引数の$requestで受け取る
    public function update(Request $request)
    {
        // $requestのupdateの値を取得して$update変数に代入する
        $update =  $request->input('update');
        // $requestのpost_idの値を取得して$post_id変数に代入する
        $post_id =  $request->input('post_id');
        // postsのDBテーブルに接続する
        DB::table('posts')
            // idカラムが$post_idに絞る
            ->where('id', $post_id)
            // 更新する処理
            ->update([
                // postsカラムに$updateの値を登録する
                'posts' => $update,
                // postsカラムに現在日時を登録する
                'updated_at' => now()
            ]);
        // 『/top』URLにアクセスする
        return redirect('/top');
    }


    //deleteメソッド
    //『/top』URLで投稿削除ボタンを押したら実行される。

    //『index.blade』からURLに引継いだidを引数の$idで受け取る
    public function delete($id)
    {
        // postsのDBテーブルに接続する
        DB::table('posts')
            // idカラムが$idに絞る
            ->where('id', $id)
            // 削除する処理
            ->delete();
        // 『/top』URLにアクセスする
        return redirect('/top');
    }

    public function test()
    {
        $auth = Auth::user();

        // followsのDBテーブルに接続して$followCount変数に代入する
        $followCount = DB::table('follows')
            // followerカラムをログインしているユーザーidに絞る
            ->where('follower', Auth::id())
            // カラム数をカウントする
            ->count();

        // followsのDBテーブルに接続して $followerCount変数に代入する
        $followerCount = DB::table('follows')
            // followカラムをログインしているユーザーidに絞る
            ->where('follow', Auth::id())
            // カラム数をカウントする
            ->count();

        $posts = DB::table("posts")
            ->where('user_id', Auth::id())
            ->get();

        return view("posts.test", compact("auth", "posts", "followCount", "followerCount"));
    }
}

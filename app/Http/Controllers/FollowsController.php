<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Auth;

class FollowsController extends Controller
{
    //followメソッド
    // フォローするボタンを押したら実行する

    //『follow』URLに引継いだidを引数の$idで受け取る
    public function follow($id)
    {
        // followsのDBテーブルに接続する
        DB::table('follows')
            // テーブルに登録する
            ->insert([
                // followカラムに$idの値を登録する
                'follow' => $id,
                // followerカラムにログインしてるユーザーidを登録する
                'follower' => Auth::id()
            ]);
        //直前のページに戻る
        return back();
    }


    // unFollowメソッド
    // フォローはずすボタンを押したら実行する

    //『unFollow』URLに引継いだidを引数の$idで受け取る
    public function unFollow($id)
    {
        // followsのDBテーブルに接続する
        DB::table('follows')
            // followカラムが$idに絞る
            ->where('follow', $id)
            // followerカラムがログインしてるユーザーidに絞る
            ->where('follower', Auth::id())
            // レコードを削除する
            ->delete();
        // 直前のベージに戻る
        return back();
    }


    //followListメソッド
    // フォローリストのボタン押してら実行される

    public function followList()
    {
        // ログインしてるユーザー情報を全て取得して$auth変数に代入する
        $auth = Auth::user();

        // followsのDBテーブルに接続して$follow_id変数に代入する
        $follow_id = DB::table('follows')
            // followerカラムがログインしてるユーザーidに絞る
            ->where('follower', Auth::id())
            // followerカラムの値を全て取得する/解説：pluckは引数で指定したカラムのみの値を取得
            ->pluck('follow');

        // usersのDBテーブルに接続して$user_icons変数に代入する
        $user_icons = DB::table('users')
            // idカラムが$follow_idに絞る
            ->whereIn('id', $follow_id)
            // 表示させるカラムを選択する
            ->select('users.id', 'users.images')
            // 全て取得する
            ->get();

        // usersのDBテーブルに接続して$users変数に代入する
        $users = DB::table('users')
            // followsのDBテーブルと連結/usersテーブルのidカラムとfollowsテーブルのfollowカラムを紐付け/解説：leftjoinは紐付けるカラムが空白は除いて表示する
            ->leftjoin('follows', 'users.id', '=', 'follows.follow')
            // postsのDBテーブルと連結/usersテーブルのidカラムとpostsテーブルのuser_idカラムを紐付け解説：leftjoinは紐付けるカラムが空白は除いて表示する
            ->leftjoin('posts', 'users.id', '=', 'posts.user_id')
            // followsテーブルのfollowerカラムがログインしているユーザーidに絞る
            ->where('follows.follower', Auth::id())
            // 表示させるカラムを選択する
            ->select('users.images', 'users.username', 'users.id', 'posts.posts', 'posts.created_at')
            // posts.created_atの表示する順番を降順に並び替えする
            ->orderby('posts.created_at', 'desc')
            // 全て取得する
            ->get();

        // / followsのDBテーブルに接続して$followings変数に代入する
        $followings = DB::table('follows')
            // followerカラムがログインしているユーザーidに絞る
            ->where('follower', Auth::id())
            // 配列として全て取得する/解説：toArrayは取得した値を配列にする
            ->get()->toArray(); //値を取得して配列にする

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
        // 『follows.followList』ファイルを表示する/ 解説：compactメソッドは引数を表示先ファイルに引継ぐ処理
        return view('follows.followList', compact('users', 'followCount', 'followerCount', 'auth', 'followings', 'user_icons'));
    }


    //followerメソッド
    // フォロワーリストのボタンを押したら実行される

    public function followerList()
    {
        // ログインしてるユーザー情報を全て取得して$auth変数に代入する
        $auth = Auth::user();

        // usersのDBテーブルに接続して$user_icons変数に代入する
        // $user_icons = DB::table('users')
        // 表示させるカラムを選択する
        // ->select('users.id', 'users.images')
        // 全て取得する
        // ->get();

        // followsのDBテーブルに接続して$follow_id変数に代入する
        $follower_id = DB::table('follows')
            // followerカラムがログインしてるユーザーidに絞る
            ->where('follow', Auth::id())
            // followerカラムの値を全て取得する/解説：pluckは引数で指定したカラムのみの値を取得
            ->pluck('follower');

        // usersのDBテーブルに接続して$user_icons変数に代入する
        $user_icons = DB::table('users')
            // idカラムが$follow_idに絞る
            ->whereIn('id', $follower_id)
            // 表示させるカラムを選択する
            ->select('users.id', 'users.images')
            // 全て取得する
            ->get();

        // usersのテーブルに接続して$users変数に代入する
        $users = DB::table('users')
            // followsのDBテーブルと連結/usersテーブルのidカラムとfollowsテーブルのfollowerカラムを紐付け/解説：leftjoinは紐付けるカラムが空白は除いて表示する
            ->leftjoin('follows', 'users.id', '=', 'follows.follower')
            // postsのDBテーブルと連結/usersテーブルのidカラムとpostsテーブルのuser_idカラムを紐付け/解説：leftjoinは紐付けるカラムが空白は除いて表示する
            ->leftjoin('posts', 'users.id', '=', 'posts.user_id')
            // followカラムがログインしてるユーザーidに絞る
            ->where('follows.follow', Auth::id())
            // 表示させるカラムを選択する
            ->select('users.images', 'users.username', 'users.id', 'posts.posts', 'posts.created_at')
            // posts.created_atの表示する順番を降順に並び替えする
            ->orderby('posts.created_at', 'desc')
            // 全て取得する
            ->get();

        // followのDBテーブルに接続して$followings変数に代入する
        $followings = DB::table('follows')
            // followerカラムがログインしてるユーザーidに絞る
            ->where('follower', Auth::id())
            ->get()->toArray(); //値を取得して配列にする

        $followCount = DB::table('follows') //DBのfollowsテーブルに接続して変数$followCountに代入する
            ->where('follower', Auth::id()) //ログインしているユーザーがfollowerにあるレコードを抜き出す●
            ->count(); //follower数をカウントする

        $followerCount = DB::table('follows') //DBのfollowsテーブルに接続して変数$followerCountに代入する
            ->where('follow', Auth::id()) //ログインしているユーザーがfollowにあるレコードを抜き出す●
            ->count(); //follow数をカウントする

        return view('follows.followerList', compact('users', 'followCount', 'followerCount', 'auth', 'followings', 'user_icons')); //follows.followListファイルに移動する/users,followCount,followerCount,authを引継ぐ
    }
}

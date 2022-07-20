<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use User;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{

    //searchメソッド
    // 『search』URLにアクセスしたら実行される。

    //『search.blade』からPOST送信された値を引数の$requestで受け取る
    public function search(Request $request)
    {
        // ログインしているユーザー情報を全て取得して$auth変数に代入する
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

        // $requestのkeywordの値を取得して$keyword変数に代入する/ 解説：inputは値を取得する
        $keyword = $request->input('keyword');

        // followsのDBテーブルに接続して$followings変数に代入する
        $followings = DB::table('follows')
            // followerカラムがログインしているユーザーidに絞る
            ->where('follower', Auth::id())
            // 配列として全て取得する/解説：toArrayは取得した値を配列にする
            ->get()->toArray();

        // $keywordに値が入ってる場合に実行する
        if ($keyword) {
            // usersのDBテーブルに接続して$user_list変数に代入する
            $user_list = DB::table('users')
                // usernameカラムが%$keyword%に絞る
                ->where('username', 'like', "%$keyword%")
                // idカラムがログインしてるユーザーid以外に絞る
                ->where('id', '<>', Auth::id())
                // 表示させるカラムを選択する
                ->select('id', 'username', 'images')
                // 全て取得する
                ->get();

            // $keywordに値が入っていない場合に実行する
        } else {
            // usersのDBテーブルに接続して$user_list変数に代入する
            $user_list = DB::table('users')
                // idカラムがログインしてるユーザーid以外に絞る
                ->where('id', '<>', Auth::id())
                // 表示させるカラムを選択する
                ->select('id', 'username', 'images')
                // 全て取得する
                ->get();
        }
        // 『users.search』ファイルを表示する/ 解説：compactメソッドは引数を表示先ファイルに引継ぐ処理
        return view('users.search', compact('auth', 'user_list', 'followCount', 'followerCount', 'followings', 'keyword'));
    }


    //profileFormメソッド
    // プロフィールボタン押したら実行される

    public function profileForm()
    {
        // ログインしているユーザー情報を全て取得して$auth変数に代入する
        $auth = Auth::user();

        // followsのDBテーブルに接続して $followCount変数に代入する
        $followCount = DB::table('follows')
            // followerカラムがログインしてるユーザーidに絞る
            ->where('follower', Auth::id())
            // カラム数をカウントする
            ->count();

        // followsのDBテーブルに接続して $followerCount変数に代入する
        $followerCount = DB::table('follows')
            // followカラムがログインしてるユーザーidに絞る
            ->where('follow', Auth::id())
            // カラム数をカウントする
            ->count();

        // usersのDBテーブルに接続して$user変数に代入する
        $user = DB::table('users')
            // idカラムがログインしてるユーザーidに絞る
            ->where('id', Auth::id())
            // 最初の値のみを取得する
            ->first();
        // 『users.profile』ファイルを表示する/ 解説：compactメソッドは引数を表示先ファイルに引継ぐ処理
        return view('users.profile', compact('user', 'auth', 'followCount', 'followerCount'));
    }

    //profileメソッド
    // プロフィールフォームで更新ボタン押したら実行される

    //『profile.blade』からPOST送信された値を引数の$requestで受け取る
    public function profile(Request $request)
    {
        // ログインしているユーザー情報を全て取得して$auth変数に代入する
        $auth = Auth::user();

        // ログインしているユーザーのmail情報を取得して$own_mail変数に代入する
        $own_mail = Auth::user()->mail;

        // $requestの値にバリデーションを設定する。
        $request->validate([
            // username=文字列、４文字以上、１２文字以下
            'username' => ['string', 'min:4', 'max:12',],
            // mail= 文字列、メール形式、４文字以上、１２文字以下、意味：DBにあるアドレスは登録不可ただしログインしてるユーザーのアドレスは除く/解説：uniqueは重複がないか判定/解説：ignoreは指定した項目はルールから除外
            'mail' => ['string', 'email', 'min:4', 'max:12', Rule::unique('users', 'mail')->ignore($own_mail, 'mail')],
            // bio=文字列、２００文字以下
            'bio' => ['string', 'max:200',],
        ]);

        // $requestのの値を全て取得して$data変数に代入する/ 解説：inputは値を取得する
        $data = $request->input();

        // $dataのnewpasswordに値が入っている場合の処理
        if ($data['newpassword']) {

            // requestのimagesに値が入っている場合の処理
            if (request('images')) { //$requestではない理由がわからない！
                // $requestのfileのimagesの画像の名前を取得して$images変数に代入する/解説：getClientOriginalNameアップロードした画像の名前をそのままで取り出す
                $images = $request->file('images')->getClientOriginalName();

                // 『public/images/』のパスに$imagesの名前でファイルを保存する/ 解説：storeAsはfileを保存できる/注意：保存先パスは何も指定しなければ、storage/app配下に保存される
                $request->file('images')->storeAs('public/images/', $images);

                // requestのimagesに値が入っていない場合の処理
            } else {
                // usersのDBテーブルに接続して$images変数に代入する
                $images = DB::table('users')
                    // idカラムがログインしているユーザーidに絞る
                    ->where('id', Auth::id())
                    // imagesカラムの値を１つのみ取得する
                    ->value('images');
            }

            // usersのDBテーブルに接続する
            DB::table('users')
                // idカラムがログインしてるユーザーidに絞る
                ->where('id', Auth::id())
                // 更新処理
                ->update([
                    // usernameカラムに$dataのusernameの値を登録する
                    'username' => $data['username'],
                    // mailカラムに$dataのmailの値を登録する
                    'mail' => $data['mail'],
                    // passwordカラムに$dataのnewpasswordの値を登録する/解説：bcryptは暗号化する処理。
                    'password' => bcrypt($data['newpassword']),
                    // bioカラムに$dataのbioの値を登録する
                    'bio' => $data['bio'],
                    // imagesカラムに$dataの$imagesの値を登録する
                    'images' => $images,
                    // updated_atカラムに現在日時を登録する
                    'updated_at' => now(),
                ]);
            // 『/top』URLにアクセスする
            return redirect('/top');

            // $dataのnewpasswordに値が入っていない場合の処理
        } else {

            // requestのimagesに値が入っている場合の処理
            if (request('images')) {
                // $requestのfileのimagesの画像の名前を取得して$images変数に代入する/解説：getClientOriginalNameアップロードした画像の名前をそのままで取り出す
                $images = $request->file('images')->getClientOriginalName();

                // 『public/images/』のパスに$imagesの名前でファイルを保存する/ 解説：storeAsはfileを保存できる/注意：保存先パスは何も指定しなければ、storage/app配下に保存される
                $request->file('images')->storeAs('public/images/', $images);

                // requestのimagesに値が入っていない場合の処理
            } else {

                // usersのDBテーブルと接続して$images変数に代入する
                $images = DB::table('users')
                    // idカラムがログインしてるidに絞る
                    ->where('id', Auth::id())
                    // imagesカラムの値を１つのみ取得する
                    ->value('images');
            }

            // usersのDBテーブルに接続する
            DB::table('users')
                // idカラムがログインしてるユーザーidに絞る
                ->where('id', Auth::id())
                // 更新処理
                ->update([
                    // usernameカラムに$dataのusernameの値を登録する
                    'username' => $data['username'],
                    // mailカラムに$dataのmailの値を登録する
                    'mail' => $data['mail'],
                    // passwordカラムに$dataのnewpasswordの値を登録する/解説：bcryptは暗号化する処理。
                    'password' => $auth->password,
                    // bioカラムに$dataのbioの値を登録する
                    'bio' => $data['bio'],
                    // imagesカラムに$dataの$imagesの値を登録する
                    'images' => $images,
                    // updated_atカラムに現在日時を登録する
                    'updated_at' => now(),
                ]);
            // 『/top』URLにアクセスする
            return redirect('/top');
        }
    }

    // otherProfileメソッド
    // ユーザーアイコンを押したら実行される

    //『follow.blade』『follower.blade』『search.blade』からURLに引継いだidを引数の$idで受け取る
    public function otherProfile($id)
    {
        // ログインしているユーザー情報を全て取得して$auth変数に代入する
        $auth = Auth::user();

        // usersのDBテーブルに接続して$user変数に代入する
        $user = DB::table('users')
            // idカラムが$idに絞る
            ->where('id', $id)
            // usersテーブルの全てのカラムを表示させる
            ->select('users.*')
            // 最初の値のみを取得する
            ->first();

        // followsのDBテーブルに接続して$followings変数に代入する
        $followings = DB::table('follows')
            // followerカラムがログインしているユーザーidに絞る
            ->where('follower', Auth::id())
            // 配列として全て取得する/解説：toArrayは取得した値を配列にする
            ->get()->toArray();

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

        // postsのDBテーブルに接続して$posts変数に代入する
        $posts = DB::table('posts')
            // usersのDBテーブルと連結/usersテーブルのidカラムとpostsテーブルのuser_idカラムを紐付ける
            ->join('users', 'users.id', '=', 'posts.user_id')
            // usersテーブルのidカラムが$idに絞る
            ->where('users.id', $id)
            // 全て取得する
            ->get();

        // 『users.otherProfile』ファイルを表示する/ 解説：compactメソッドは引数を表示先ファイルに引継ぐ処理
        return view('users.otherProfile', compact('auth', 'user', 'followings', 'followCount', 'followerCount', 'posts'));
    }
}

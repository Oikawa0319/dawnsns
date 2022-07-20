<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/add'; //分からない

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() //分からない
    {
        $this->middleware('guest'); //分からない
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'username' => 'required|string|max:255',
    //         'mail' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|min:4|confirmed',
    //     ]);
    // }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */




    // registerメソッド
    // 『/register』URLにアクセスするか、『register.blade』からpost送信されたら実行される。

    //『register.blade』からPOST送信された値を引数の$requestで受け取る
    public function register(Request $request)
    {
        // 『register.blade』からpost送信された場合に実行される。
        if ($request->isMethod('post')) {
            // $requestの値にバリデーションを設定する。
            $request->validate(
                [
                    //username=入力必須、文字列必須、４文字以上、１２文字以下
                    'username' => 'required|string|min:4|max:12',
                    //mail=入力必須、email形式、４文字以上、DBに登録済みmail登録不可
                    'mail' => 'required|email|min:4|unique:users,mail',
                    //password=入力必須、４文字以上、１２文字以下、「password_confirmation」と連携し同じ内容かチェック
                    'password' => 'required|min:4|max:12|confirmed',
                    //password_confirmation=入力必須、４文字以上、１２文字以下
                    'password_confirmation' => 'required|min:4|max:12',
                ],
                [
                    // バリデーションが満たされなかった場合のエラーメッセージの表示設定
                    'required' => 'この項目は必須です。',
                    'min' => '４文字以上入力が必要です。',
                    'max' => '１２文字以内で入力して下さい。',
                    'unique' => 'すでに使用されているメールアドレスです。',
                    'confirmed' => 'パスワードが一致しません。',
                ]
            );
            // $requestの値を全て取得して$data変数に代入する/解説：inputは値を取得する
            $data = $request->input();
            // 同じclassのcreateメソッドに$dataの値を引数として渡す。
            $this->create($data);
            // $requestのusernameの値を取得して$username変数に代入する。/解説：inputは値を取得する
            $username = $request->input('username');
            // 『auth.added』ファイルを表示する。/解説：compactメソッドは引数を表示先ファイルに引継ぐ処理。
            return view("auth.added", compact('username'));
        }
        // バリデーションに引っ掛かった場合は『auth.register』を表示する。
        return view("auth.register");
    }



    // createメソッド
    // registerメソッドのバリデーション処理時に引数で渡されたら実行する。

    // registerメソッドから渡された$dataの引数を受け取りarrayで配列にする。
    protected function create(array $data) //arrayで受け取る理由が分からない
    {
        // UserモデルでDBのUserテーブルに値を登録する。
        return User::create([
            // usernameカラムに$dataのusernameの値を登録する。
            'username' => $data['username'],
            // mailカラムに$dataのmailの値を登録する。
            'mail' => $data['mail'],
            // passwordカラムに$dataのpasswordの値を登録する。/解説：bcryptは暗号化する処理。
            'password' => bcrypt($data['password']),
        ]);
    }
}

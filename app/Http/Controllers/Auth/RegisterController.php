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
    protected $redirectTo = '/add';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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

     //createメソッド/registerメソッドの$data変数をarrayに引数で渡し、$dataとして使用出来る様にする
    protected function create(array $data)
    {
        //UserモデルでDBのUserテーブルに接続し、追加
        return User::create([
            //$dataのusernameの値をusernameカラムに追加する
            'username' => $data['username'],
            //$dataのmailの値をmailカラムに追加する
            'mail' => $data['mail'],
            //$dataのpasswordの値をpasswordカラムに追加する/bcryptで登録後のpasswordを暗号化する
            'password' => bcrypt($data['password']),
        ]);
    }


    // public function registerForm(){
    //     return view("auth.register");
    // }

    //registerメソッド/「register.blade.php」からPOST送信された値を引数の$repuestで受け取る
    public function register(Request $request)
    {
        //$requestの値がpost送信された場合下記を実行する
        if ($request->isMethod('post')) {
                //requestの値にバリデーションを設定する
                $request->validate(
                    [
                        //username=入力必須、文字列必須、４文字以上、１２文字以下
                        'username' => 'required|string|min:4|max:12',
                        //mail=入力必須、email形式、４文字以上、同じmail登録不可
                        'mail' => 'required|email|min:4|unique:users,mail',
                        //password=入力必須、４文字以上、１２文字以下、「password_confirmation」と連携し同じ内容かチェックする
                        'password' => 'required|min:4|max:12|confirmed',
                        //password_confirmation=入力必須、４文字以上、１２文字以下
                        'password_confirmation' => 'required|min:4|max:12',
                    ],[
                        //バリデーションが満たされなかった場合のエラー表示
                        'required' => 'この項目は必須です。',
                        'min' => '４文字以上入力が必要です。',
                        'max' => '１２文字以内で入力して下さい。',
                        'unique' => 'すでに使用されているメールアドレスです。',
                        'confirmed' => 'パスワードが一致しません。',
                        ]
                );
            //requestの値を取得し$data変数に代入する
            $data = $request->input();

            //createメソットに$dataを引数で渡す
            $this->create($data);
            //requestの値のusernameの値を$username変数に代入する
            $username = $request->input('username');
            //auth.addedファイルにusernameの値を引き継ぐ
            return view("auth.added",compact('username'));
        }
            //バリデーションがエラーの場合auth.registerファイルに移動する
            return view("auth.register");
    }
}

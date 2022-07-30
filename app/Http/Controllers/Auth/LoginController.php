<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/index'; //分からない

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() //分からない
    {
        $this->middleware('guest')->except('logout'); //分からない
    }



    //◎loginメソッド
    // 『login.blade』からpost送信されたら実行される

    // 『login.blade』のnameの値を$requestに持ってくる
    public function login(Request $request)
    {
        // 『login.blade』からpost送信された場合に実行される
        if ($request->isMethod('post')) {
            // $requestのmailとpasswordの値を取得して$data変数に代入する/解説：onlyは引数に指定したカラムの値のみ取得する
            $data = $request->only('mail', 'password');
            // $dataの値がDBに登録されているか判定し成功なら認証可/解説：attemptは認証をtrue(成功)かfalse(失敗)で返します。
            if (Auth::attempt($data)) {
                // 認証可の場合は『/top』URLを表示する
                return redirect('/top');
            }
        }
        // post送信前と認証失敗の場合は『auth.login』ファイルを表示する
        return view("auth.login");
    }



    //logoutメソッド
    // ログアウトボタン押したら実行される

    public function logout()
    {
        // ログインしているユーザーをログアウトする/解説：ユーザーの認証情報をクリアにする●
        Auth::logout();
        // 『/logout』URLにアクセスする
        return redirect('/login');
    }
}

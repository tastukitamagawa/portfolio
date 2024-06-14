<?php

namespace App\Http\Controllers;

use Illuminate\Auth\AuthServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function create(){
        return view('login');
    }

    public function login(Request $request){
        $validation = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($request->email === 'guest@example.com'){
            return redirect()->route('userLogin')->withErrors([
                'guest-email' => 'メールアドレスまたはパスワードが正しくありません。',
            ])->onlyInput('guest-email'); 
        }

        if(Auth::attempt($validation)){
            // セッションIDの再生成
            $request->session()->regenerate();
            // 認証ユーザーの情報取得
            $user = Auth::user();
            // セッションに保存
            $request->session()->put('user', $user);

            return redirect('/');
        }

        return redirect()->route('userLogin')->withErrors([
            'login-error' => 'メールアドレスまたはパスワードが正しくありません。',
        ])->onlyInput('login-error'); 
    }
}

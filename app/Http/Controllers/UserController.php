<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create(){
        return view('register'); 
    }   

    public function store(Request $request){
        $validated = $request->validate([
            'username' => 'required|string',
            'email' => 'required|string|unique:users',
            'password' => 'required|confirmed|min:8|regex:/^(?=.*[a-z])(?=.*[0-9])[a-z0-9]+$/'
        ]);

        $user = new User();
        $user->username = $validated['username']; // ユーザー名をセット
        $user->email = $validated['email']; // メールアドレスをセット
        $user->password = Hash::make($validated['password']); // パスワードをハッシュ化してセット
        $user->save();

        return redirect()->route('login')->with('register_success', '登録が完了しました。ログインできます。');
    }
}

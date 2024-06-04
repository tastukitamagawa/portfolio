<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class MyPageController extends Controller
{
    public function create(){
        $user = Auth::user();
        return view('mypage', compact('user'));
    } 

    public function logout(Request $request){
        Auth::logout();
        // 現在使っているセッションの無効化
        $request->session()->invalidate();
        // セッション無効化を再生成する
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function update(Request $request){
        // データベースに登録されている情報を取得
        $currentUser = User::find(Auth::id());

        
        // バリデーション設定
        $validated = $request->validate([
            'username' => 'nullable|string',
            'email' => 'nullable|string|unique:users,email',
            'password' => 'nullable|string',
            'new_password' => 'nullable|confirmed|min:8|regex:/^(?=.*[a-z])(?=.*[0-9])[a-z0-9]+$/'
        ]);

        // 更新された情報を格納する変数
        $updatedFields = [];
        if($request->username){
            $currentUser->username = $validated['username'];
            $updatedFields[] = "ユーザー情報";
        } 
        if($request->email){
            $currentUser->email = $validated['email'];
            $updatedFields[] = "メールドレス";
        }
        if(password_verify($validated['password'], $currentUser->password) && $request->new_password){
            $currentUser->password = Hash::make($validated['new_password']);
            $updatedFields[] = "パスワード";
        }

        $message = "";
        if($updatedFields){
            $message = implode("、", $updatedFields). "が更新されました。";
        }

        $currentUser->save();
        return redirect()->back()->with('update_success', $message);
    }
}

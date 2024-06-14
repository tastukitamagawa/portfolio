<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserUpdateController extends Controller
{
    public function create(){
        return view('profile-update'); 
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
        $inputFields = ['username', 'email', 'password', 'new_password', 'new_password_confirmation'];
        // 入力が全て未入力の時の処理
        $allFieldsEmpty = true;
        foreach($inputFields as $inputField){
            // 入力されていたらfalseにする
            if($request->filled($inputField)){
                $allFieldsEmpty = false;
                break;
            }
        } 

        if($allFieldsEmpty){
            redirect()->back()->withErrors(["current_password_error" => "更新したい項目を入力してください。"]);
        }

        if($request->username){
            $currentUser->username = $validated['username'];
            $updatedFields[] = "ユーザー名";
        } 
        if($request->email){
            $currentUser->email = $validated['email'];
            $updatedFields[] = "メールドレス";
        }
        if(isset($request->password) && $request->new_password){
            $currentUser->password = Hash::make($validated['new_password']);
            $updatedFields[] = "パスワード";
        } else if(isset($request->password) && password_verify($validated['password'], $currentUser->password) === false){
            return redirect()->back()->withErrors(["current_password_error" => "現在のパスワードが正しくありません。"]);
        } else if(!isset($request->password) && isset($request->new_password)){
            return redirect()->back()->withErrors(["current_password_error" => "現在のパスワードを入力してください。"]);
        } else if(isset($request->password) && !isset($request->new_password)){
            return redirect()->back()->withErrors(["current_password_error" => "新しいパスワードを設定してください。"]);
        }

        $message = "";
        if($updatedFields){
            $message = implode("、", $updatedFields). "が更新されました。";
        }

        $currentUser->save();
        return redirect()->back()->with('update_success', $message);
    }
}

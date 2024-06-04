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
}

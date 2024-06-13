<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class MyPageController extends Controller
{
    public function create(){
        $user = Auth::user();
        return view('mypage', compact('user'));
    } 

    public function logout(Request $request){
        try{
            Auth::logout();
            // 現在使っているセッションの無効化
            $request->session()->invalidate();
            // セッション無効化を再生成する
            $request->session()->regenerateToken();
    
            return redirect()->route('login');
        } catch(\Exception $e){
            Log::error('Error updating word: ' . $e->getMessage());
        }
    }

    public function delete(){
        try{
            User::where('id', auth()->id())->delete();
            return redirect()->route('login');
        } catch(\Exception $e){
            Log::error('Error updating word: ' . $e->getMessage());
        }
    }
}

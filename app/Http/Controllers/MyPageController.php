<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Word;
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

    public function guestLogout(){
        try {
            $user_id = auth()->id();
            // ログアウトするとアカウント削除
            User::where('id', $user_id)->delete();
            $words = Dictionary::where('user_id', $user_id)->get();
            foreach($words as $word){
                // 単語削除
                Word::where('word_id', $word->word_id)->delete();
            }
            return redirect()->route('login');
        } catch (\Exception $e){
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

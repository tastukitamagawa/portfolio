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
        Auth::logout();
        // 現在使っているセッションの無効化
        $request->session()->invalidate();
        // セッション無効化を再生成する
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function guestLogout(){
        $user_id = auth()->id();
        // ログアウトするとアカウント削除
        $guest_words = Dictionary::where('user_id', $user_id)->get();
        foreach($guest_words as $guest_word){
            // 単語削除
            Word::where('word_id', $guest_word->word_id)->delete();
        }
        User::where('id', $user_id)->delete();
        return redirect()->route('login');
    }

    public function delete(){
        $user_words = Dictionary::where('user_id', auth()->id())->get();
        foreach($user_words as $user_word){
            // 単語削除
            Word::where('word_id', $user_word->word_id)->delete();
        }
        User::where('id', auth()->id())->delete();
        return redirect()->route('login');
    }
}

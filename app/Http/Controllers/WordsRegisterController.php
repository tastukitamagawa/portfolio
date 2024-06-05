<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Word;

class WordsRegisterController extends Controller
{
    public function create(){
        return view(('/word-register'));
    }

    public function register(Request $request){
        $validated = $request->validate([
            'word' => 'required|string|regex:/^[a-zA-z]+$/',
            'meaning' => 'nullable|string|regex:/^[a-zA-Z,.&\s\n]+$/',
        ]);

        $word = new Word();
        $word->word = $validated['word'];
        $word->meaning = $validated['meaning'];
        $word->save();
        return back()->with('word_register_success', '英単語を登録しました。');
    }
}

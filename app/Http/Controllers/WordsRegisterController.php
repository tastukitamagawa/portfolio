<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use Illuminate\Http\Request;
use App\Models\Word;

class WordsRegisterController extends Controller
{
    public function create(){
        return view('/word-register');
    }

    public function register(Request $request){
        $validated = $request->validate([
            'word' => 'required|string|regex:/^[a-zA-z]+$/',
            'meaning' => 'required|string|regex:/^[a-zA-Z,.&\s\n]+$/',
        ]);

        $word = new Word();
        $dictionary = new Dictionary();
        // wordsのデータベースに登録
        $word->word = $validated['word'];
        $word->meaning = $validated['meaning'];
        $word->save();
        // dictionariesのデータベースに登録
        $dictionary->user_id = auth()->id();
        $dictionary->word_id = $word->id;
        $dictionary->save();
        return back()->with('word_register_success', '英単語を登録しました。');
    }
}

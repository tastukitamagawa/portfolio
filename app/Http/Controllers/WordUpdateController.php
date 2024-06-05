<?php

namespace App\Http\Controllers;

use App\Models\Word;
use Illuminate\Http\Request;

class WordUpdateController extends Controller
{
    public function create(Request $request){
        session(['word_id' => request()->query('id')]);
        $word = Word::where('word_id', session('word_id'))->firstOrFail();
        // セッションに保存
        return view('/word-update', compact('word'));
    }
    
    public function update(Request $request){
        // 現在表示されている単語
        // dd(session('word_id'));
        $currentWord = Word::where('word_id', session('word_id'))->firstOrFail();
        $validated = $request->validate([
            'word' => 'nullable|string|regex:/^[a-zA-z]+$/',
            'meaning' => 'nullable|string|regex:/^[a-zA-Z,.&\s\n]+$/',
        ]);

        $currentWord->word = $validated['word'];
        // if($request->word){
        // }

        $currentWord->save();

        return redirect('/');
    }
}

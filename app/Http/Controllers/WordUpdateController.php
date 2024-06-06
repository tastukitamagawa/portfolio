<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
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
        $currentWord = Word::where('word_id', session('word_id'))->firstOrFail();
        $validated = $request->validate([
            'word' => 'nullable|string|regex:/^[a-zA-z]+$/',
            'meaning' => 'nullable|string|regex:/^[a-zA-Z,.&\s\n]+$/',
        ]);

        $isChanged = false;
        if($validated['word'] != null &&  $currentWord->word != $validated['word']){
            $currentWord->word = $validated['word'];
            $isChanged = true;
        }
        if($validated['meaning'] != null && $currentWord->meaning != $validated['meaning']){
            $currentWord->meaning = $validated['meaning'];
            $isChanged = true;
        }
        if(!$isChanged){
            return back()->withErrors(['word_update_fail' => '更新したい項目を変更してください。']);
        }
        $currentWord->save();

        return redirect('/');
    }

    public function delete(){
        Word::where('word_id', session('word_id'))->delete();
        return redirect('/');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use Illuminate\Http\Request;
use App\Models\Word;
use Illuminate\Support\Facades\Log;

class WordsRegisterController extends Controller
{
    public function create(){
        return view('/word-register');
    }

    public function register(Request $request){
        $validated = $request->validate([
            'word' => 'required|string|regex:/^[a-zA-z]+$/',
            'meaning' => 'nullable|string|regex:/^[a-zA-Z,.&\s\n]+$/',
        ]);

        $word = new Word();
        // wordsのデータベースに登録
        $word->word = $validated['word'];

        // wordsAPIの設定
        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', 'https://wordsapiv1.p.rapidapi.com/words/'.$word->word.'/definitions', [
            'headers' => [
                'x-rapidapi-host' => 'wordsapiv1.p.rapidapi.com',
                'x-rapidapi-key' => '0cef2f2d8cmshb68b84535fb820ep19a65bjsn15140a4837ef',
            ],
        ]);
        $definitions = json_decode($response->getBody()->getContents(), true);

        $word->meaning = $definitions['definitions'][0]['definition'];

        $word->save();

        // dictionariesのデータベースに登録
        $dictionary = new Dictionary();
        $dictionary->user_id = auth()->id();
        $dictionary->word_id = $word->word_id;
        $dictionary->save();        

        return back()->with('word_register_success', '英単語を登録しました。');
    }
}

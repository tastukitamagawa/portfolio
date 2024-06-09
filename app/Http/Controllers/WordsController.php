<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use App\Jobs\GenerateAudioFiles;

class WordsController extends Controller
{
    public function create($id){
        $word = Dictionary::where("user_id", auth()->id())->where('word_id', $id)->with('word')->orderBy('created_at')->first();
        return view('words', compact('word'));
    }

    public function getWords(){
        $words = Dictionary::where("user_id", auth()->id())->with('word')->orderBy('created_at')->get();
        $chunks = array_chunk($words->toArray(), 5);

        // ハッシュマップ
        $hashmap = [];
        foreach($words as $word){
            $hashmap[] = [
                'word_id' => $word->word->word_id,
                'word' => $word->word->word,
                'meaning' => $word->word->meaning,
            ];
        }

        foreach($chunks as $chunk){
            GenerateAudioFiles::dispatch($chunk)->onQueue('audio_generation');
        }

        return response()->json($hashmap);
    }
}

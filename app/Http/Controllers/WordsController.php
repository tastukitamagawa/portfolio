<?php

namespace App\Http\Controllers;

use App\Events\WordsChunkDispatched;
use App\Models\Dictionary;
use App\Jobs\GenerateAudioFiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WordsController extends Controller
{
    public function create(Request $request){
        $amount = $request->input('amount') ? (int)$request->input('amount') : Dictionary::where("user_id", auth()->id())->count();
        session(['limitAmount' => $amount]);
        $word = Dictionary::where("user_id", auth()->id())->with('word')->orderBy('created_at')->first();
        if($word){
            return view('words', compact('word'));
        } else{
            return redirect()->route('wordsRegister');
        }
    }

    public function getWords(){
        $limitAmount = session()->get('limitAmount');
        $words = Dictionary::where("user_id", auth()->id())->with('word')->orderBy('created_at')->limit($limitAmount)->get();
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
            // イベントは発生
            event(new WordsChunkDispatched($chunk));
        }

        return response()->json($hashmap);
    }
}

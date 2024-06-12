<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use App\Models\Word;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

class WordUpdateController extends Controller
{
    public function create(Request $request, $word_id = null){
        $word = Word::where('word_id', $word_id)->firstOrFail();
        return view('/word-update', compact('word'));
    }
    
    public function update(Request $request, $word_id = null){
        try{
            // 現在表示されている単語
            $currentWord = Word::where('word_id', $word_id)->firstOrFail();
            $validated = $request->validate([
                'word' => 'nullable|string|regex:/^[a-zA-Z]+$/',
                'meaning' => 'nullable|string|regex:/^[\s\S]*$/',
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

            return redirect()->route('top');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors());
        } catch(\Exception $e) {
            Log::error('Error updating word: ' . $e->getMessage());
            return back()->withErrors(['word_update_fail' => 'エラーが発生しました。もう一度お試しください。']);
        }
    }

    public function delete($word_id = null){
        try{
            Word::where('word_id', $word_id)->delete();
            return redirect()->route('top');
        } catch(\Exception $e){
            Log::error('Error updating word: ' . $e->getMessage());
        }
    }
}

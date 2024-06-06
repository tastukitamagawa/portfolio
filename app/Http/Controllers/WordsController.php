<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use Illuminate\Http\Request;

class WordsController extends Controller
{
    public function create($id){
        $word = Dictionary::where("user_id", auth()->id())->where('word_id', $id)->with('word')->orderBy('created_at')->first();
        return view('words', compact('word'));
    }
}

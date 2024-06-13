<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WordsListController extends Controller
{
    public function create(Request $request){
        try{
            $limit = $request->input('limit', 10);
            $list = Dictionary::where('user_id', auth()->id())->with('word')->orderBy('updated_at', 'desc')->paginate($limit);
            $word_id = Dictionary::where('user_id', auth()->id())->with('word')->value('word_id');
            return view('/index', compact('list', 'limit', 'word_id'));
        } catch(\Exception $e){
            Log::error('Error updating word: ' . $e->getMessage());
        }
    }
}

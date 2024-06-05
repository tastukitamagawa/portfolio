<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use Illuminate\Http\Request;

class WordsListController extends Controller
{
    public function create(Request $request){
        $limit = $request->input('limit', 10);
        $list = Dictionary::where('user_id', auth()->id())->with('word')->orderBy('updated_at', 'desc')->paginate($limit);
        return view('/index', compact('list', 'limit'));
    }
}

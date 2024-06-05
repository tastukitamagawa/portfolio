<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use Illuminate\Http\Request;

class WordsListController extends Controller
{
    public function create(){
        $list = Dictionary::where('user_id', auth()->id())->with('word')->get();
        return view('/index', compact('list'));
    }
}

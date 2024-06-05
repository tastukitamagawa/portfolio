<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WordsListController extends Controller
{
    public function create(){
        return view('/index');
    }
}

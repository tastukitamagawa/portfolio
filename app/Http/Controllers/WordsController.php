<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WordsController extends Controller
{
    public function create(){
        return view('/words');
    }
}

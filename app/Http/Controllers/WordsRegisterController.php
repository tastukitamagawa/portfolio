<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WordsRegisterController extends Controller
{
    public function create(){
        return view(('/word-register'));
    }
}

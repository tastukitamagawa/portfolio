<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

// トップページの表示
Route::get('/', function () {
    return view('index');
});

// 単語ページの表示
Route::get('/words', function () {
    return view('words');
});

// 単語登録ページの表示
Route::get('/word-register', function () {
    return view('word-register');
});

// 単語修正ページの表示
Route::get('/word-update', function () {
    return view('word-update');
});

// マイページの表示
Route::get('/mypage', function () {
    return view('mypage');
});

// 登録情報修正の表示
Route::get('/profile-update', function () {
    return view('profile-update');
});

// ログイン
Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('login', [LoginController::class, 'login']);

// 新規登録
Route::get('/register', [RegisterController::class, 'create']);
Route::post('users', [RegisterController::class, 'store'])->name('users.store');
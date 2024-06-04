<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\GuestLoginController;
use App\Http\Controllers\MyPageController;

// トップページの表示
Route::get('/', function () {
    return view('index');
})->middleware('auth');

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
Route::get('/mypage', [MyPageController::class, 'create'])->middleware('auth')->name('myPage');
// ログアウト
Route::post('/mypage/logout', [MyPageController::class, 'logout'])->name('logout');
// ユーザー情報の更新
Route::post('/mypage/update', [MyPageController::class, 'update'])->name('update');

// 登録情報修正の表示
Route::get('/profile-update', function () {
    return view('profile-update');
});

// ログイン
Route::get('/login', [LoginController::class, 'create']);
Route::post('/login', [LoginController::class, 'login'])->name('login.login');

// ゲストログイン
Route::post('/guest-login', [GuestLoginController::class, 'guest'])->name('guestLogin');

// 新規登録
Route::get('/register', [UserController::class, 'create']);
Route::post('/register', [UserController::class, 'store'])->name('user.store');
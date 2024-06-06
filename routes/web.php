<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\GuestLoginController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\UserUpdateController;
use App\Http\Controllers\WordsListController;
use App\Http\Controllers\WordsRegisterController;
use App\Http\Controllers\WordUpdateController;

// トップページの表示
Route::get('/', [WordsListController::class, 'create'])->middleware('auth')->name('top');
Route::get('/words-limit', [WordsListController::class, 'create'])->middleware('auth')->name('listLimit');

// 単語ページの表示
Route::get('/words', function () {
    return view('words');
});

// 単語登録ページの表示
Route::get('/words-register', [WordsRegisterController::class, 'create'])->middleware('auth')->name('words-register');
// 単語登録
Route::post('/words-register/add', [WordsRegisterController::class, 'register'])->name('wordsAdd');

// 単語更新ページの表示
Route::get('/word-update', [WordUpdateController::class, 'create'])->middleware('auth')->name('wordUpdate');
// 単語更新
Route::post('/word-update/edit', [WordUpdateController::class, 'update'])->name('wordEdit');
// 単語削除
Route::delete('/word-update/delete', [WordUpdateController::class, 'delete'])->name('wordDelete');

// マイページの表示
Route::get('/mypage', [MyPageController::class, 'create'])->middleware('auth')->name('myPage');
// ログアウト
Route::post('/mypage/logout', [MyPageController::class, 'logout'])->name('logout');
// ユーザー情報の更新
Route::post('/mypage/update', [MyPageController::class, 'update'])->name('update');

// 登録情報修正の表示
Route::get('/profile-update', [UserUpdateController::class, 'create'])->middleware('auth')->name('profileUpdate');
Route::Post('profileUpdate/update', [UserUpdateController::class, 'update'])->name('profileUpdate.update');

// ログイン
Route::get('/login', [LoginController::class, 'create']);
Route::post('/login', [LoginController::class, 'login'])->name('login.login');

// ゲストログイン
Route::post('/guest-login', [GuestLoginController::class, 'guest'])->name('guestLogin');

// 新規登録
Route::get('/register', [UserController::class, 'create']);
Route::post('/register', [UserController::class, 'store'])->name('user.store');
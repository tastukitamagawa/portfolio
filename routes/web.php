<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\GuestLoginController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\UserUpdateController;
use App\Http\Controllers\WordsController;
use App\Http\Controllers\WordsListController;
use App\Http\Controllers\WordsRegisterController;
use App\Http\Controllers\WordUpdateController;
use App\Http\Middleware\GuestLogin;

Route::middleware(['auth'])->group(function(){
    // トップページの表示
    Route::get('/', [WordsListController::class, 'create'])->name('top');
    // 制限をつける
    Route::get('/words-limit', [WordsListController::class, 'create'])->name('listLimit');
    
    // 単語ページの表示
    Route::post('/words', [WordsController::class, 'create'])->name('words');
    // 音声ファイルの作成とjsonデータの作成
    Route::post('/get-words', [WordsController::class, 'getWords']);
    
    // 単語登録ページの表示
    Route::get('/words-register', [WordsRegisterController::class, 'create'])->name('wordsRegister');
    // 単語登録
    Route::get('/words-register/add', [WordsRegisterController::class, 'register'])->name('wordsAdd');
    
    // 単語更新ページの表示
    Route::get('/word-update/{word_id}', [WordUpdateController::class, 'create'])->name('wordUpdate');
    // 単語更新
    Route::patch('/word-update/{word_id}/edit', [WordUpdateController::class, 'update'])->name('wordEdit');
    // 単語削除
    Route::delete('/word-update/{word_id}/delete/', [WordUpdateController::class, 'delete'])->name('wordDelete');

    // マイページの表示
    Route::get('/mypage', [MyPageController::class, 'create'])->name('myPage');
    // ログアウト
    Route::post('/mypage/logout', [MyPageController::class, 'logout'])->name('logout');
    // ゲストログアウト
    Route::delete('/mypage/guest-logout', [MyPageController::class, 'guestLogout'])->name('guestLogout');

    // 登録情報修正の表示
    Route::get('/profile-update', [UserUpdateController::class, 'create'])->name('profileUpdate');
    Route::Post('/profile-update/update', [UserUpdateController::class, 'update'])->name('profileUpdate.update');

    // アカウント削除
    Route::delete('/mypage/delete', [MyPageController::class, 'delete'])->name('delete');
});

// 新規登録
Route::get('/register', [UserController::class, 'create']);
Route::post('/register', [UserController::class, 'store'])->name('user.store');

// ログイン
Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('userLogin');

// ゲストログイン
Route::post('/guest-login', [GuestLoginController::class, 'login'])->name('guestLogin');


Route::fallback(function () {
    return redirect()->route('login');
});
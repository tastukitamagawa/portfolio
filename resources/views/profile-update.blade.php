@extends('layouts.default')

@section('title', 'P.E.Dictionary')

@section('content')
    <div class="profile-update-box box">
        <form action="" class="profile-update-form">
            <div class="profile-update-form__input-wrap input-wrap">
                <label for="">
                    <span class="profile-update-form__text">ニックネーム</span>
                    <input class="profile-update-form__input input" type="text" name="" id="">
                </label>
            </div>
            <div class="profile-update-form__input-wrap input-wrap">
                <label for="">
                    <span class="profile-update-form__text">メールアドレス</span>
                    <input class="profile-update-form__input input" type="email" name="" id="">
                </label>
            </div>
            <div class="profile-update-form__input-wrap input-wrap">
                <label for="">
                    <span class="profile-update-form__text">パスワード</span>
                    <input class="profile-update-form__input input" type="password" name="" id="">
                </label>
            </div>
            <div class="profile-update-form__input-wrap input-wrap">
                <label for="">
                    <span class="profile-update-form__text">パスワード（確認）</span>
                    <input class="profile-update-form__input input" type="password" name="" id="">
                </label>
            </div>

            <div class="profile-update-form__button-area form-button-area">
                <button class="profile-update-form__button button" type="submit">修正する</button>
                <button class="profile-update-form__button button border-button" type="submit">キャンセルする</button>
            </div>
        </form>
    </div>

@endsection
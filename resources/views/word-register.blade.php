@extends('layouts.default')

@section('title', 'P.E.Dictionary')

@section('content')
    <div class="word-register-box box">
        <form action="" class="word-register-form">
            <div class="word-register-form__input-wrap input-wrap">
                <label for="">
                    <span class="word-register-form__text">Word</span>
                    <input class="word-register-form__input input" type="text" name="" id="">
                </label>
            </div>
            <div class="word-register-form__input-wrap input-wrap">
                <label for="">
                    <span class="word-register-form__text">Meaning</span>
                    <textarea class="word-register-form__input input" name="" id=""></textarea>
                </label>
            </div>

            <div class="word-register-form__button-area form-button-area">
                <button class="word-register-form__button button" type="submit">登録する</button>
                <button class="word-register-form__button button border-button" type="submit">キャンセルする</button>
            </div>
        </form>
    </div>

@endsection
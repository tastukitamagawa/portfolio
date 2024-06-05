@extends('layouts.default')

@section('title', 'P.E.Dictionary')

@section('content')
    <div class="word-register-box box">
        <form action="" class="word-register-form">
            @csrf
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
                <button class="word-register-form__button button" type="submit">修正する</button>
                <button class="word-register-form__button button border-button" type="submit">削除する</button>
            </div>
        </form>
    </div>

    <a href="{{route('top')}}" class="word-update__back-button button">一覧へ戻る</a>

@endsection
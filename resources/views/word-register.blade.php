@extends('layouts.default')

@section('title', 'P.E.Dictionary')

@section('content')
    <div class="word-register-box box">
        @if (session('word_register_success'))
            <p class="alert-message">{{session('word_register_success')}}</p>
        @endif
        <form action="{{route('wordsAdd')}}" class="word-register-form" method="POST">
            @csrf
            <div class="word-register-form__input-wrap input-wrap">
                <label for="word">
                    <span class="word-register-form__text">Word</span>
                    <input class="word-register-form__input input" type="text" name="word" id="word" value="{{old("word")}}">
                </label>
                @if ($errors->has('word'))
                    <p class="error">{{$errors->first('word')}}</p>
                @endif
            </div>
            <div class="word-register-form__input-wrap input-wrap">
                <label for="meaning">
                    <span class="word-register-form__text">Meaning</span>
                    <textarea class="word-register-form__input input" name="meaning" id="meaning">{{old("meaning")}}</textarea>
                </label>
                @if ($errors->has('meaning'))
                    <p class="error">{{$errors->first('meaning')}}</p>
                @endif
            </div>

            <div class="word-register-form__button-area form-button-area">
                <button class="word-register-form__button button" type="submit">登録する</button>
                <a href="" class="word-register-form__button button border-button" role="button">戻る</a>
            </div>
        </form>
    </div>

@endsection
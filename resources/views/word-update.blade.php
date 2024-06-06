@extends('layouts.default')

@section('title', 'P.E.Dictionary')

@section('content')
    <div class="word-register-box box">
        @if ($errors->has('word_update_fail'))
            <div class="update-alert-box">
                <p class="update-alert-error">{{$errors->first('word_update_fail')}}</p>
            </div>
        @endif
        <form action="{{route('wordEdit')}}" class="word-register-form" method="POST">
            @csrf
            <div class="word-register-form__input-wrap input-wrap">
                <label for="word">
                    <span class="word-register-form__text">Word</span>
                    <input class="word-register-form__input input" type="text" name="word" id="word" value="{{old('word', $word->word)}}">
                </label>
            </div>
            <div class="word-register-form__input-wrap input-wrap">
                <label for="meaning">
                    <span class="word-register-form__text">Meaning</span>
                    <textarea class="word-register-form__input input" name="meaning" id="meaning">{{old('meaning', $word->meaning)}}</textarea>
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
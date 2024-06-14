@extends('layouts.default')

@section('title', 'P.E.Dictionary')

@section('content')
    <div class="word-register-box box">
        @if ($errors->has('word_update_fail'))
            <div class="update-alert-box">
                <p class="update-alert-error">{{$errors->first('word_update_fail')}}</p>
            </div>
        @endif
        <form action="{{route('wordEdit', ['word_id' => $word->word_id])}}" class="word-register-form" method="POST">
            @csrf
            @method('PATCH')
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
                <button class="word-register-form__button button text--ja" type="submit">修正する</button>
            </div>
        </form>
        <form action="{{route('wordDelete', ['word_id' => $word->word_id])}}" method="POST">
            @csrf
            @method('DELETE')
            <button class="word-delete-form__button button border-button text--ja" type="submit">削除する</button>
        </form>
    </div>

    <a href="{{route('top')}}" class="word-update__back-button button">一覧へ戻る</a>

@endsection
@extends('layouts.default')

@section('title', 'P.E.Dictionary')

@section('content')
    <form class="dictionary-form" action="">
        <div class="dictionary-form__word-amount">
            <span class="text text--ja">再生する単語数</span>
            <span class="dictionary-form__input-wrap text--ja">
                <input class="dictionary-form__word-amount-input" type="text" inputmode="numeric" pattern="\d*">個
            </span>
        </div>
        <button class="dictionary-form__button" type="submit text--ja">再生する</button>
    </form>

    <form class="word-list-setting" action="">
        <div class="word-list-setting__input-wrap">
            <select class="word-list-setting__input" name="" id="">
                <option value="10">10</option>
                <option value="10">30</option>
                <option value="10">50</option>
                <option value="10">100</option>
            </select>
        </div>
    </form>

    <ul class="word-list">
        @foreach ($list as $word)
            <li class="word">
                <h2 class="word__title text--ja">{{$word->word->word}}</h2>
                <p class="word__meaning">{{$word->word->meaning}}</p>
            </li>
        @endforeach
    </ul>
@endsection('content')


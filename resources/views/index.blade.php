@extends('layouts.default')

@section('title', 'P.E.Dictionary')

@section('content')
    <form class="dictionary-form" action="{{secure_url(route('words'))}}" method="POST">
        @csrf
        <div class="dictionary-form__word-amount">
            <span class="text text--ja">再生する単語数</span>
            <span class="dictionary-form__input-wrap text--ja">
                <input class="dictionary-form__word-amount-input" type="text" inputmode="numeric" name="amount" pattern="\d*" value="{{old('amount')}}">個
            </span>
        </div>
        <button class="dictionary-form__button text--ja" type="submit">開始する</button>
    </form>

    <form class="word-list-setting" action="{{secure_url(route('listLimit'))}}" method="GET">
        <div class="word-list-setting__input-wrap">
            <select class="word-list-setting__input" name="limit" id="">
                <option value="10" {{$limit == 10 ? 'selected' : ''}}>10</option>
                <option value="30" {{$limit == 30 ? 'selected' : ''}}>30</option>
                <option value="50" {{$limit == 50 ? 'selected' : ''}}>50</option>
                <option value="100" {{$limit == 100 ? 'selected' : ''}}>100</option>
            </select>
        </div>
        <button class="word-list-setting__button button text--ja" type="submit">表示する</button>
    </form>

    <ul class="word-list">
        @foreach ($list as $word)
            <li class="word">
                <div class="word-text-area">
                    <h2 class="word__title text--ja">{{$word->word->word}}</h2>
                    <p class="word__meaning">{{$word->word->meaning}}</p>
                </div>
                <a href="{{route('wordUpdate',['word_id' => $word->word->word_id])}}" class="word-update-link">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="#5f6368"><path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z"/></svg>
                </a>
            </li>
        @endforeach
    </ul>
    <div class="pagination">
        {{$list->links()}}
    </div>
@endsection('content')

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

    <form class="word-list-setting" action="{{route('listLimit')}}" method="GET">
        <div class="word-list-setting__input-wrap">
            <select class="word-list-setting__input" name="limit" id="">
                <option value="10" {{$limit == 10 ? 'selected' : ''}}>10</option>
                <option value="30" {{$limit == 30 ? 'selected' : ''}}>30</option>
                <option value="50" {{$limit == 50 ? 'selected' : ''}}>50</option>
                <option value="100" {{$limit == 100 ? 'selected' : ''}}>100</option>
            </select>
        </div>
        <button class="word-list-setting__button button" type="submit">表示する</button>
    </form>

    <ul class="word-list">
        @foreach ($list as $word)
            <li class="word">
                <h2 class="word__title text--ja">{{$word->word->word}}</h2>
                <p class="word__meaning">{{$word->word->meaning}}</p>
            </li>
        @endforeach
    </ul>
    <div class="pagination">
        {{$list->links()}}
    </div>
@endsection('content')


@extends('layouts.default')

@section('title', 'P.E.Dictionary')

@section('content')
    <div class="word-box box">
        <h2 class="word-box__title" id="word">{{$word->word->word}}</h2>
        <p class="word-box__meaning" id="meaning">{{$word->word->word}}</p>
        <audio class="voice" id="word-voice" controls>
            <source src="{{asset('storage/voice/word'.$word->word->word_id.'.mp3')}}" type="audio/mpeg">
        </audio>
        <audio class="voice" id="meaning-voice" controls>
            <source src="{{asset('storage/voice/meaning'.$word->word->word_id.'.mp3')}}" type="audio/mpeg">
        </audio>
        <div class="word-box__operation-area">
            <span class="word-box__operation-icon is-prev">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="none"><path d="M560-280 360-480l200-200v400Z"/></svg>
            </span>
            <span class="word-box__operation-icon is-stop">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="none"><path d="M320-640v320-320Zm-80 400v-480h480v480H240Zm80-80h320v-320H320v320Z"/></svg>
            </span>
            <span class="word-box__operation-icon is-next">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill=none"><path d="M400-280v-400l200 200-200 200Z"/></svg>
            </span>
        </div>
    </div>
@endsection
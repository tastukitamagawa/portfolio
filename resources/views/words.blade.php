@extends('layouts.default')

@section('title', 'P.E.Dictionary')

@section('content')
    <div class="word-box box">
        <h2 class="word-box__title" id="word">{{$word->word->word}}</h2>
        <p class="word-box__meaning" id="meaning">{{$word->word->meaning}}</p>
        <audio class="voice" id="word-voice" controls>
            <source src="{{asset('storage/voice/word'.$word->word->word_id.'.mp3', true)}}" type="audio/mpeg">
        </audio>
        <audio class="voice" id="meaning-voice">
            <source src="{{asset('storage/voice/meaning'.$word->word->word_id.'.mp3', true)}}" type="audio/mpeg">
        </audio>
        <div class="word-box__operation-area">
            <span class="word-box__operation-icon is-prev" id="word-prev-button" role="button">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="none"><path d="M560-280 360-480l200-200v400Z"/></svg>
            </span>
            <span class="word-box__operation-icon is-stop" id="voice-stop-button" role="button">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="none"><path d="M320-640v320-320Zm-80 400v-480h480v480H240Zm80-80h320v-320H320v320Z"/></svg>
            </span>
            <span class="word-box__operation-icon is-start is-hide" id="voice-start-button" role="button">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="#5f6368"><path d="M320-200v-560l440 280-440 280Zm80-280Zm0 134 210-134-210-134v268Z"/></svg>
            </span>
            <span class="word-box__operation-icon is-next" id="word-next-button" role="button">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill=none"><path d="M400-280v-400l200 200-200 200Z"/></svg>
            </span>
        </div>
    </div>
@endsection
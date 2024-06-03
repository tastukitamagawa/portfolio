@extends('layouts.default')

@section('title', 'P.E.Dictionary')

@section('content')
    <div class="mypage-box box">
        <ul class="mypage-list">
            <li class="mypage-list__item">
                <div class="mypage-list__item-text-area">
                    <span class="mypage-list__item-title">ニックネーム</span>
                    <span class="mypage-list__item-text">名前</span>
                </div>
                    <form class="mypage-list__item-form" action="">
                    <button class="mypage-list__item--form-button">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z"/></svg>
                    </button>
                </form>
            </li>
            <li class="mypage-list__item">
                <div class="mypage-list__item-text-area">
                    <span class="mypage-list__item-title">メールアドレス</span>
                    <span class="mypage-list__item-text">test@example.com</span>
                </div>
                    <form class="mypage-list__item-form" action="">
                    <button class="mypage-list__item--form-button">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z"/></svg>
                    </button>
                </form>
            </li>
            <li class="mypage-list__item">
                <div class="mypage-list__item-text-area">
                    <span class="mypage-list__item-title">パスワード</span>
                    <span class="mypage-list__item-text">●●●●●●●●●</span>
                </div>
                    <form class="mypage-list__item-form" action="">
                    <button class="mypage-list__item--form-button">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z"/></svg>
                    </button>
                </form>
            </li>
        </ul>
    </div>

    <div class="mypage-button-area">
        <form action="" class="mypage-form mypage-form-logout">
            <button class="mypage-form__button button" type="submit text--ja">ログアウトする</button>
        </form>
        <form action="" class="mypage-form mypage-form-delete">
            <button class="mypage-form__button button border-button" type="submit text--ja">削除する</button>
        </form>
    </div>
@endsection
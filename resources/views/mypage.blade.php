@extends('layouts.default')

@section('title', 'P.E.Dictionary')

@section('content')
    <div class="mypage-box box">
        @if (session('update_success'))
            <div class="update-alert-box">
                <p class="update-alert-success">{{session('update_success')}}</p>
            </div>
        @endif
        <ul class="mypage-list">
            <li class="mypage-list__item">
                <div class="mypage-list__item-text-area">
                    <span class="mypage-list__item-title">ユーザー名</span>
                    @if (isset($user))
                        <span class="mypage-list__item-text">{{$user->username}}</span>
                    @endif
                </div>
                @if (isset($user) && $user->id !==1)
                    <div class="mypage-setting__icon" role="button" data-user_update="modal-name">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z"/></svg>
                    </div>
                @endif
            </li>
            @if (isset($user) && $user->id !== 1)
                <li class="mypage-list__item">
                    <div class="mypage-list__item-text-area">
                        <span class="mypage-list__item-title">メールアドレス</span>
                        @if (isset($user))
                            <span class="mypage-list__item-text">{{$user->email}}</span>
                        @endif
                    </div>
                    <div class="mypage-setting__icon" role="button" data-user_update="modal-email">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z"/></svg>
                    </div>
                </li>
                <li class="mypage-list__item">
                    <div class="mypage-list__item-text-area">
                        <span class="mypage-list__item-title">パスワード</span>
                    </div>
                    <div class="mypage-setting__icon" role="button" data-user_update="modal-password">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z"/></svg>
                    </div>
                </li>
            @endif
        </ul>
    </div>

    <div class="modal__bg" id="modal-name">
        <div class="modal">
            <p class="modal__text">ユーザー名を変更する</p>
            <form class="mypage-modal-form modal-form" action="{{route("update")}}" method="POST">
                @csrf
                <div class="modal-form__input-wrap">
                    <label class="modal-form__label" for="name">新しいユーザー名</label>
                    <input class="modal-form__input input" type="text" name="username" id="name">
                </div>
                <div class="form-button-area">
                    <button class="login-form__button button" type="submit">更新する</button>
                    <div class="login-form__button modal-cancel-button button border-button" role="button">キャンセルする</div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal__bg" id="modal-email">
        <div class="modal">
            <p class="modal__text">メールアドレスを変更する</p>
            <form class="mypage-modal-form modal-form" action="{{route("update")}}" method="POST">
                @csrf
                <div class="modal-form__input-wrap">
                    <label class="modal-form__label" for="email">新しいメールアドレス</label>
                    <input class="modal-form__input input" type="email" name="email" id="email">
                </div>
                <div class="form-button-area">
                    <button class="login-form__button button" type="submit">更新する</button>
                    <div class="login-form__button modal-cancel-button button border-button" role="button">キャンセルする</div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal__bg" id="modal-password">
        <div class="modal">
            <p class="modal__text">パスワードを変更する</p>
            <form class="mypage-modal-form modal-form" action="{{route("update")}}" method="POST">
                @csrf
                <div class="modal-form__input-wrap current-password-wrap">
                    <label class="modal-form__label" for="password">現在のパスワード</label>
                    <input class="modal-form__input input" type="password" name="password" id="password">
                </div>
                <div class="modal-form__input-wrap">
                    <label class="modal-form__label" for="new_password">新しいパスワード</label>
                    <input class="modal-form__input input" type="password" name="new_password" id="new_password">
                </div>
                <div class="modal-form__input-wrap">
                    <label class="modal-form__label" for="name">新しいパスワード（確認）</label>
                    <input class="modal-form__input input" type="password" name="password_confirmation" id="password_confirmation">
                </div>
                <div class="form-button-area">
                    <button class="login-form__button button" type="submit">更新する</button>
                    <div class="login-form__button modal-cancel-button button border-button" role="button">キャンセルする</div>
                </div>
            </form>
        </div>
    </div>

    <div class="mypage-button-area">
        <form action="{{route('logout')}}" class="mypage-form mypage-form-logout" method="POST">
            @csrf
            <button class="mypage-form__button button" type="submit text--ja">ログアウトする</button>
        </form>
        <form action="" class="mypage-form mypage-form-delete">
            <button class="mypage-form__button button border-button" type="submit text--ja">削除する</button>
        </form>
    </div>
@endsection
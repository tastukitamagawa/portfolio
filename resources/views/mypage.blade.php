@extends('layouts.default')

@section('title', 'P.E.Dictionary')

@section('content')
    <div class="mypage-box box">
        <ul class="mypage-list">
            <li class="mypage-list__item">
                <div class="mypage-list__item-text-area">
                    <span class="mypage-list__item-title">ユーザー名</span>
                    @if (isset($user))
                        <span class="mypage-list__item-text">{{$user->username}}</span>
                    @endif
                </div>
            </li>
            @if (isset($user) && $user->id !== 1)
                <li class="mypage-list__item">
                    <div class="mypage-list__item-text-area">
                        <span class="mypage-list__item-title">メールアドレス</span>
                        @if (isset($user))
                            <span class="mypage-list__item-text">{{$user->email}}</span>
                        @endif
                    </div>
                </li>
                <li class="mypage-list__item">
                    <div class="mypage-list__item-text-area">
                        <span class="mypage-list__item-title">パスワード</span>
                    </div>
                </li>
            @endif
        </ul>
        <a href="{{route('profileUpdate')}}" class="to-profile-update-button button">ユーザー情報を更新する</a>
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
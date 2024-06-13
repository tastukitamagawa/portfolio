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
        @if (isset($user) && $user->id !== 1)
            <a href="{{route('profileUpdate')}}" class="to-profile-update-button button">ユーザー情報を更新する</a>
        @endif
    </div>

    <div class="mypage-button-area">
        <form action="{{route('logout')}}" class="mypage-form mypage-form-logout" method="POST">
            @csrf
            <button class="mypage-form__button button" id="logout-button" type="submit text--ja">ログアウトする</button>
        </form>
        @if (isset($user) && $user->id !== 1)
        <form action="{{route('delete')}}" class="mypage-form mypage-form-delete" method="POST">
            @csrf
            @method('DELETE')
            <button class="mypage-form__button button border-button text--ja" type="submit">削除する</button>
        </form>
        @endif
    </div>
@endsection
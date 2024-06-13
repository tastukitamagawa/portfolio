@extends('layouts.default')

@section('title', 'P.E.Dictionary')

@section('content')
    <div class="mypage-box box">
        <ul class="mypage-list">
            <li class="mypage-list__item">
                <div class="mypage-list__item-text-area">
                    <span class="mypage-list__item-title text--ja">ユーザー名</span>
                    @if (isset($user))
                        <span class="mypage-list__item-text">{{$user->username}}</span>
                    @endif
                </div>
            </li>
            @if (isset($user) && $user->id !== 1)
                <li class="mypage-list__item">
                    <div class="mypage-list__item-text-area">
                        <span class="mypage-list__item-title text--ja">メールアドレス</span>
                        @if (isset($user))
                            <span class="mypage-list__item-text">{{$user->email}}</span>
                        @endif
                    </div>
                </li>
                <li class="mypage-list__item">
                    <div class="mypage-list__item-text-area">
                        <span class="mypage-list__item-title text--ja">パスワード</span>
                    </div>
                </li>
            @endif
        </ul>
        @if (isset($user) && $user->id !== 1)
            <a href="{{route('profileUpdate')}}" class="to-profile-update-button button text--ja">ユーザー情報を更新する</a>
        @endif
    </div>

    <div class="mypage-button-area">
        <form action="{{route('logout')}}" class="mypage-form mypage-form-logout" method="POST">
            @csrf
            <button class="mypage-form__button button text--ja" id="logout-button" type="submit">ログアウトする</button>
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
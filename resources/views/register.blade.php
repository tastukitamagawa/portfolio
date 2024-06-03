@extends('layouts.default')

@section('title', 'P.E.Dictionary')

@section('content')
    <div class="login-container">
        <h2 class="login-container__title text--ja">新規登録</h2>
        <form action="{{route('users.store')}}" method="post" class="login-form">
            @csrf
            <label class="login-form__input-wrap" for="name">
                <div class="login-form__input-wrap--top">
                    <span class="login-form__input-text">ユーザー名</span>
                    <span class="required">必須</span>
                </div>
                <input class="login-form__input input" type="text" name="username" id="name" placeholder="ユーザー名" value="{{old("username")}}">
                @if ($errors->has('username'))
                    <p class="error">{{$errors->first('username')}}</p>
                @endif
            </label>
            <label class="login-form__input-wrap" for="email">
                <div class="login-form__input-wrap--top">
                    <span class="login-form__input-text">メールアドレス</span>
                    <span class="required">必須</span>
                </div>
                <input class="login-form__input input" type="email" name="email" id="email" placeholder="example@example.com" value="{{old("email")}}">
                @if ($errors->has('email'))
                    <p class="error">{{$errors->first('email')}}</p>
                @endif
            </label>
            <label class="login-form__input-wrap" for="password">
                <div class="login-form__input-wrap--top">
                    <span class="login-form__input-text">パスワード</span>
                    <span class="required">必須</span>
                </div>
                <input class="login-form__input input" type="password" name="password" id="password" placeholder="パスワード">
                @if ($errors->has('password'))
                    <p class="error">{{$errors->first('password')}}</p>
                @endif
            </label>
            <label class="login-form__input-wrap" for="password_confirm">
                <div class="login-form__input-wrap--top">
                    <span class="login-form__input-text">パスワード（確認）</span>
                    <span class="required">必須</span>
                </div>
                <input class="login-form__input input" type="password" name="password_confirmation" id="password_confirm" placeholder="パスワード（確認）">
            </label>

            <div class="login-form__button-area form-button-area">
                <button class="login-form__button button" type="submit">登録する</button>
                <a href="{{'login'}}" class="login-form__button button border-button">キャンセルする</a>
            </div>
        </form>
    </div>
@endsection
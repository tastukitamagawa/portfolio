@extends('layouts.default')

@section('title', 'P.E.Dictionary')

@section('content')
    <div class="login-container">
        <h2 class="login-container__title text--ja">ログイン</h2>
        <form action="{{route('login')}}" method="POST" class="login-form">
            @csrf
            <label class="login-form__input-wrap" for="">
                <span class="login-form__input-text">メールアドレス</span>
                <input class="login-form__input input" type="email" name="" id="" placeholder="example@example.com" value="{{old('email')}}">
            </label>
            <label class="login-form__input-wrap" for="">
                <span class="login-form__input-text">パスワード</span>
                <input class="login-form__input input" type="password" name="" id="" placeholder="パスワード">      
            </label>

            <div class="login-form__button-area form-button-area">
                <button class="login-form__button button" type="submit">ログインする</button>
                <a href="{{"register"}}" class="login-form__button button border-button">新規登録</a>
            </div>
        </form>

        <form class="guest-login" action="">
            <button class="guest-login__button button" type="submit">ゲストとしてログインする</button>
        </form>
    </div>
@endsection
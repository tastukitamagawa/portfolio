@extends('layouts.default')

@section('title', 'P.E.Dictionary')

@section('content')
    <div class="login-container">
        <h2 class="login-container__title text--ja">ログイン</h2>
        @if (session('register_success'))
            <p class="alert-message">{{session('register_success')}}</p>
        @endif
        @if ($errors->has('login-error'))
            <p class="login-error">{{$errors->first('login-error')}}</p>
        @endif
        @if ($errors->has('guest-email'))
            <p class="login-error">{{$errors->first('guest-email')}}</p>
        @endif

        <form action="{{secure_url(route('userLogin'))}}" method="POST" class="login-form">
            @csrf
            <label class="login-form__input-wrap" for="">
                <span class="login-form__input-text text--ja">メールアドレス</span>
                <input class="login-form__input input" type="email" name="email" id="" placeholder="example@example.com" value="{{old('email')}}">
                @if ($errors->has('email'))
                    <p class="error">{{$errors->first('email')}}</p>
                @endif
            </label>
            <label class="login-form__input-wrap" for="">
                <span class="login-form__input-text text--ja">パスワード</span>
                <input class="login-form__input input" type="password" name="password" id="" placeholder="パスワード">    
                @if ($errors->has('password'))
                    <p class="error">{{$errors->first('password')}}</p>
                @endif  
            </label>

            <div class="login-form__button-area form-button-area">
                <button class="login-form__button button text--ja" type="submit">ログインする</button>
                <a href="{{"register"}}" class="login-form__button button border-button text--ja">新規登録</a>
            </div>
        </form>

        <form class="guest-login" action="{{secure_url(route('guestLogin'))}}" method="POST">
            @csrf
            <button class="guest-login__button button text--ja" type="submit">ゲストとしてログインする</button>
        </form>
    </div>
@endsection
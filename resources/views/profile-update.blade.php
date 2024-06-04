@extends('layouts.default')

@section('title', 'P.E.Dictionary')

@section('content')
    <div class="profile-update-box box">
        @if (session('update_success'))
            <p class="update-alert-success">{{session('update_success')}}</p>
        @endif
        @if ($errors->any())
            <div class="update-alert-box">
                @foreach ($errors->all() as $error)
                    <p class="update-alert-error">{{$error}}</p>
                @endforeach
            </div>
        @endif

        <form action="{{route("profileUpdate.update")}}" class="profile-update-form" method="POST">
            @csrf
            <div class="profile-update-form__input-wrap input-wrap">
                <label for="name">
                    <span class="profile-update-form__text">ニックネーム</span>
                    <input class="profile-update-form__input input" type="text" name="username" id="name">
                </label>
            </div>
            <div class="profile-update-form__input-wrap input-wrap">
                <label for="email">
                    <span class="profile-update-form__text">メールアドレス</span>
                    <input class="profile-update-form__input input" type="email" name="email" id="email">
                </label>
            </div>
            <div class="profile-update-form__input-wrap input-wrap">
                <label for="password">
                    <span class="profile-update-form__text">現在のパスワード</span>
                    <input class="profile-update-form__input input" type="password" name="password" id="password">
                </label>
            </div>
            <div class="profile-update-form__input-wrap input-wrap">
                <label for="new_password">
                    <span class="profile-update-form__text">新しいパスワード</span>
                    <input class="profile-update-form__input input" type="password" name="new_password" id="new_password">
                </label>
            </div>
            <div class="profile-update-form__input-wrap input-wrap">
                <label for="password_confirmation">
                    <span class="profile-update-form__text">新しいパスワード（確認）</span>
                    <input class="profile-update-form__input input" type="password" name="new_password_confirmation" id="new_password_confirmation">
                </label>
            </div>

            <div class="profile-update-form__button-area form-button-area">
                <button class="profile-update-form__button button" type="submit">更新する</button>
                <a href="{{route('myPage')}}" class="profile-update-form__button button border-button" role="button">戻る</a>
            </div>
        </form>
    </div>

@endsection
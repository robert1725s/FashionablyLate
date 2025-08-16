@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}" />
@endsection

@section('button')
    <div class="login-btn-wrapper">
        <a href="/login" class="login-btn">login</a>
    </div>
@endsection

@section('page-title')
    Register
@endsection

@section('content')
    <form class="register__form" action="/register" method="post">
        @csrf

        <!-- 名前 -->
        <div class="register__form-group">
            <label class="register__label" for="name">お名前</label>
            <input type="text" name="name" class="register__input" placeholder="例: 山田　太郎" value="{{ old('name') }}">
            @error('name')
                <p class="error-message">※{{ $message }}</p>
            @enderror
        </div>

        <!-- メールアドレス -->
        <div class="register__form-group">
            <label class="register__label" for="email">メールアドレス</label>
            <input name="email" class="register__input" placeholder="例: test@example.com" value="{{ old('email') }}">
            @error('email')
                <p class="error-message">※{{ $message }}</p>
            @enderror
        </div>

        <!-- パスワード -->
        <div class="register__form-group">
            <label class="register__label" for="password">パスワード</label>
            <input type="password" name="password" class="register__input" placeholder="例: coachtech1106">
            @error('password')
                <p class="error-message">※{{ $message }}</p>
            @enderror
        </div>

        <!-- 登録ボタン -->
        <div class="register__submit">
            <button type="submit" class="register__btn">登録</button>
        </div>
    </form>
@endsection

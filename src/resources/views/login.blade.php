@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
@endsection

@section('button')
    <a href="/register" class="register-btn">register</a>
@endsection

@section('page-title')
    Login
@endsection

@section('content')
    <form class="login__form">
        <div class="login__form-group">
            <label class="login__label" for="email">メールアドレス</label>
            <input type="email" name="email" class="login__input" placeholder="例: test@example.com" value="{{ old('email') }}">
            @error('email')
                <p class="error-message">※{{ $message }}</p>
            @enderror
        </div>
        <div class="login__form-group">
            <label class="login__label" for="password">パスワード</label>
            <input type="password" name="password" class="login__input" placeholder="例: coachtech1106" value="{{ old('password') }}">
            @error('password')
                <p class="error-message">※{{ $message }}</p>
            @enderror
        </div>
        <div class="login__submit">
            <button type="submit" class="login__btn">ログイン</button>
        </div>
    </form>
@endsection

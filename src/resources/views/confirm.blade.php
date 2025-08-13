@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}" />
@endsection

@section('page-title')
    Confirm
@endsection

@section('content')
    <div class="confirm__content">
        <div class="confirm__row">
            <div class="confirm__label">お名前</div>
            <div class="confirm__value">山田 太郎</div>
        </div>

        <div class="confirm__row">
            <div class="confirm__label">性別</div>
            <div class="confirm__value">男性</div>
        </div>

        <div class="confirm__row">
            <div class="confirm__label">メールアドレス</div>
            <div class="confirm__value">test@example.com</div>
        </div>

        <div class="confirm__row">
            <div class="confirm__label">電話番号</div>
            <div class="confirm__value">08012345678</div>
        </div>

        <div class="confirm__row">
            <div class="confirm__label">住所</div>
            <div class="confirm__value">東京都渋谷区千駄ヶ谷1-2-3</div>
        </div>

        <div class="confirm__row">
            <div class="confirm__label">建物名</div>
            <div class="confirm__value">千駄ヶ谷マンション101</div>
        </div>

        <div class="confirm__row">
            <div class="confirm__label">お問い合わせの種類</div>
            <div class="confirm__value">商品の交換について</div>
        </div>

        <div class="confirm__row confirm__row--detail">
            <div class="confirm__label">お問い合わせ内容</div>
            <div class="confirm__value confirm__value--detail">
                届いた商品が注文した商品ではありませんでした。<br>
                届いた商品が注文した商品ではありませんでした。
                商品の取り替えをお願いします。
            </div>
        </div>
    </div>

    <div class="confirm__btns">
        <button type="submit" class="confirm__btn confirm__btn--submit">送信</button>
        <button type="button" class="confirm__btn confirm__btn--edit">修正</button>
    </div>
@endsection

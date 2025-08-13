@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}" />
@endsection

@section('page-title')
    Contact
@endsection

@section('content')
    <form class="contact__form" action="/contacts/confirm" method="post">
        @csrf
        <!-- お名前 -->
        <div class="contact__item">
            <label class="contact__label contact--required">お名前</label>
            <div class="contact__name-group">
                <input type="text" name="last-name" class="contact__input" placeholder="例：山田"
                    value="{{ old('last_name') }}">
                <input type="text" name="first-name" class="contact__input" placeholder="例：太郎"
                    value="{{ old('first_name') }}">
            </div>
        </div>

        <!-- 性別 -->
        <div class="contact__item">
            <label class="contact__label contact--required">性別</label>
            <div class="contact__radio-group">
                <label class="contact__radio-item">
                    <input type="radio" name="gender" value="male" checked
                        {{ old('gender') == 'male' ? 'checked' : '' }}>
                    <span class="contact__radio-custom"></span>
                    男性
                </label>
                <label class="contact__radio-item">
                    <input type="radio" name="gender" value="female" {{ old('gender') == 'female' ? 'checked' : '' }}>
                    <span class="contact__radio-custom"></span>
                    女性
                </label>
                <label class="contact__radio-item">
                    <input type="radio" name="gender" value="other" {{ old('gender') == 'other' ? 'checked' : '' }}>
                    <span class="contact__radio-custom"></span>
                    その他
                </label>
            </div>
        </div>

        <!-- メールアドレス -->
        <div class="contact__item">
            <label class="contact__label contact--required">メールアドレス</label>
            <input type="email" name="email" class="contact__input" placeholder="例：test@example.com"
                value="{{ old('email') }}">
        </div>

        <!-- 電話番号 -->
        <div class="contact__item">
            <label class="contact__label contact--required">電話番号</label>
            <div class="contact__tel-group">
                <input type="text" name="tel-1" class="contact__input contact__tel" placeholder="080"
                    value="{{ old('tel-1') }}">
                <span class="tel-separator">-</span>
                <input type="text" name="tel-2" class="contact__input contact__tel" placeholder="1234"
                    value="{{ old('tel-2') }}">
                <span class="tel-separator">-</span>
                <input type="text" name="tel-3" class="contact__input contact__tel" placeholder="5678"
                    value="{{ old('tel-3') }}">
            </div>
        </div>

        <!-- 住所 -->
        <div class="contact__item">
            <label class="contact__label contact--required">住所</label>
            <input type="text" name="address" class="contact__input" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3"
                value="{{ old('address') }}">
        </div>

        <!-- 建物名 -->
        <div class="contact__item">
            <label class="contact__label">建物名</label>
            <input type="text" name="building" class="contact__input" placeholder="例：千駄ヶ谷マンション101"
                value="{{ old('building') }}">
        </div>

        <!-- お問い合わせの種類 -->
        <div class="contact__item">
            <label class="contact__label contact--required">お問い合わせの種類</label>
            <div class="contact__select-wrapper">
                <select name="contact_type" class="contact__select">
                    <option value="">選択してください</option>
                    <option value="商品のお届けについて" {{ old('contact_type') == '商品のお届けについて' ? 'selected' : '' }}>商品のお届けについて
                    </option>
                    <option value="商品の交換について" {{ old('contact_type') == '商品の交換について' ? 'selected' : '' }}>商品の交換について</option>
                    <option value="商品トラブル" {{ old('contact_type') == '商品トラブル' ? 'selected' : '' }}>商品トラブル</option>
                    <option value="ショップへのお問い合わせ" {{ old('contact_type') == 'ショップへのお問い合わせ' ? 'selected' : '' }}>ショップへのお問い合わせ
                    </option>
                    <option value="その他" {{ old('contact_type') == 'その他' ? 'selected' : '' }}>その他</option>
                </select>
            </div>
        </div>

        <!-- お問い合わせ内容 -->
        <div class="contact__item">
            <label class="contact__label contact--required">お問い合わせ内容</label>
            <textarea name="detail" class="contact__textarea" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
        </div>

        <!-- 送信ボタン -->
        <div class="contact__submit">
            <button type="submit" class="contact__submit-btn">確認画面</button>
        </div>
    </form>
@endsection

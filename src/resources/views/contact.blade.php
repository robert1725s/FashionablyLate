@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}" />
@endsection

@section('page-title')
    Contact
@endsection

@section('content')
    <form class="contact__form" action="/contact/confirm" method="post">
        @csrf
        <!-- お名前 -->
        <div class="contact__item">
            <label class="contact__label contact--required">お名前</label>
            <div class="contact__name-group">
                <div class="contact__value-wrapper">
                    <input type="text" name="last_name" class="contact__input" placeholder="例：山田"
                        value="{{ old('last_name', $contactData['last_name'] ?? '') }}">
                    @error('last_name')
                        <p class="error-message">※{{ $message }}</p>
                    @enderror
                </div>
                <div class="contact__value-wrapper">
                    <input type="text" name="first_name" class="contact__input" placeholder="例：太郎"
                        value="{{ old('first_name', $contactData['first_name'] ?? '') }}">
                    @error('first_name')
                        <p class="error-message">※{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- 性別 -->
        <div class="contact__item">
            <label class="contact__label contact--required test">性別</label>
            <div class="contact__value-wrapper">
                <div class="contact__radio-group">
                    <label class="contact__radio-item">
                        <input type="radio" name="gender" value=1 checked
                            {{ old('gender', $contactData['gender'] ?? '') == 1 ? 'checked' : '' }}>
                        <span class="contact__radio-custom"></span>
                        男性
                    </label>
                    <label class="contact__radio-item">
                        <input type="radio" name="gender" value=2
                            {{ old('gender', $contactData['gender'] ?? '') == 2 ? 'checked' : '' }}>
                        <span class="contact__radio-custom"></span>
                        女性
                    </label>
                    <label class="contact__radio-item">
                        <input type="radio" name="gender" value=3
                            {{ old('gender', $contactData['gender'] ?? '') == 3 ? 'checked' : '' }}>
                        <span class="contact__radio-custom"></span>
                        その他
                    </label>
                </div>
            </div>
        </div>

        <!-- メールアドレス -->
        <div class="contact__item">
            <label class="contact__label contact--required">メールアドレス</label>
            <div class="contact__value-wrapper">
                <input name="email" class="contact__input" placeholder="例：test@example.com"
                    value="{{ old('email', $contactData['email'] ?? '') }}">
                @error('email')
                    <p class="error-message">※{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- 電話番号 -->
        <div class="contact__item">
            <label class="contact__label contact--required">電話番号</label>
            <div class="contact__value-wrapper">
                <div class="contact__tel-group">
                    <input type="text" name="tel-1" class="contact__input contact__tel" placeholder="080"
                        value="{{ old('tel-1', $contactData['tel-1'] ?? '') }}">
                    <span class="tel-separator">-</span>
                    <input type="text" name="tel-2" class="contact__input contact__tel" placeholder="1234"
                        value="{{ old('tel-2', $contactData['tel-2'] ?? '') }}">
                    <span class="tel-separator">-</span>
                    <input type="text" name="tel-3" class="contact__input contact__tel" placeholder="5678"
                        value="{{ old('tel-3', $contactData['tel-3'] ?? '') }}">
                </div>
                @if ($errors->has('tel'))
                    @foreach ($errors->get('tel') as $message)
                        <p class="error-message">※{{ $message }}</p>
                    @endforeach
                @endif
            </div>
        </div>

        <!-- 住所 -->
        <div class="contact__item">
            <label class="contact__label contact--required">住所</label>
            <div class="contact__value-wrapper">
                <input type="text" name="address" class="contact__input" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3"
                    value="{{ old('address', $contactData['address'] ?? '') }}">
                @error('address')
                    <p class="error-message">※{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- 建物名 -->
        <div class="contact__item">
            <label class="contact__label">建物名</label>
            <input type="text" name="building" class="contact__input" placeholder="例：千駄ヶ谷マンション101"
                value="{{ old('building', $contactData['building'] ?? '') }}">
        </div>

        <!-- お問い合わせの種類 -->
        <div class="contact__item">
            <label class="contact__label contact--required">お問い合わせの種類</label>
            <div class="contact__value-wrapper">
                <div class="contact__select-wrapper">
                    <select name="category_id" class="contact__select">
                        <option value="">選択してください</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category['id'] }}"
                                {{ old('category_id', $contactData['category_id'] ?? '') == $category['id'] ? 'selected' : '' }}>
                                {{ $category['content'] }}</option>
                        @endforeach
                    </select>
                </div>
                @error('category_id')
                    <p class="error-message">※{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- お問い合わせ内容 -->
        <div class="contact__item">
            <label class="contact__label contact--required">お問い合わせ内容</label>
            <div class="contact__value-wrapper">
                <textarea name="detail" class="contact__textarea" placeholder="お問い合わせ内容をご記載ください">{{ old('detail', $contactData['detail'] ?? '') }}</textarea>
                @error('detail')
                    <p class="error-message">※{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- 送信ボタン -->
        <div class="contact__submit">
            <button type="submit" class="contact__submit-btn">確認画面</button>
        </div>
    </form>
@endsection

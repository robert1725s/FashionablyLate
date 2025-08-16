@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}" />
@endsection

@section('page-title')
    Confirm
@endsection

@section('content')
    <div class="confirm-wrapper">
        <form class="confirm__form" method="POST" action="/contact/complete">
            @csrf
            <div class="confirm__row">
                <div class="confirm__label">お名前</div>
                <div class="confirm__value">
                    {{ $contact['last_name'] }}　{{ $contact['first_name'] }}
                </div>
                <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}" />
                <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}" />
            </div>

            <div class="confirm__row">
                <div class="confirm__label">性別</div>
                <div class="confirm__value">
                    @switch($contact['gender'])
                        @case(1)
                            男性
                        @break

                        @case(2)
                            女性
                        @break

                        @default
                            その他
                    @endswitch
                </div>
                <input type="hidden" name="gender" value="{{ $contact['gender'] }}" />
            </div>

            <div class="confirm__row">
                <div class="confirm__label">メールアドレス</div>
                <input class="confirm__value" name="email" value="{{ $contact['email'] }}" readonly />
            </div>

            <div class="confirm__row">
                <div class="confirm__label">電話番号</div>
                <input class="confirm__value" name="tel"
                    value="{{ $contact['tel-1'] . $contact['tel-2'] . $contact['tel-3'] }}" readonly />
            </div>

            <div class="confirm__row">
                <div class="confirm__label">住所</div>
                <input class="confirm__value" name="address" value="{{ $contact['address'] }}" readonly />
            </div>

            <div class="confirm__row">
                <div class="confirm__label">建物名</div>
                <input class="confirm__value" name="building" value="{{ $contact['building'] }}" readonly />
            </div>

            <div class="confirm__row">
                <div class="confirm__label">お問い合わせの種類</div>
                <input class="confirm__value" value="{{ $category['content'] }}" readonly />
                <input name="category_id" value="{{ $category['id'] }}" type="hidden" />
            </div>
            <div class="confirm__row confirm__row--detail">
                <div class="confirm__label">お問い合わせ内容</div>
                <textarea class="confirm__value" name="detail" readonly>{{ $contact['detail'] }}</textarea>
            </div>

            <div class="confirm__btns">
                <button type="submit" class="confirm__btn confirm__btn--submit">送信</button>
                <a href="/" class="confirm__btn confirm__btn--edit">修正</a>
            </div>
        </form>
    </div>
@endsection

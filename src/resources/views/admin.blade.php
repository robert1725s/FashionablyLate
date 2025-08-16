@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
@endsection

@section('button')
    <form class="logout-form" action="logout" method="post">
        @csrf
        <button type="submit" class="logout-btn">logout</button>
    </form>
@endsection

@section('page-title')
    Admin
@endsection

@section('content')
    <div class="admin__container">
        <!-- 検索フォーム -->
        <form class="admin__search" action="/admin/search" method="post">
            @csrf

            <!-- キーワード -->
            <input type="text" name="keyword" class="admin__search-input" placeholder="名前やメールアドレスを入力してください"
                value="{{ $searchParams['keyword'] ?? '' }}">

            <!-- 性別 -->
            <div class="admin__search--icon">
                <select class="admin__search-select admin__search-select--gender" name="gender">
                    <option value="">性別</option>
                    <option value="0" {{ ($searchParams['gender'] ?? '') == '0' ? 'selected' : '' }}>全て</option>
                    <option value="1" {{ ($searchParams['gender'] ?? '') == '1' ? 'selected' : '' }}>男性</option>
                    <option value="2" {{ ($searchParams['gender'] ?? '') == '2' ? 'selected' : '' }}>女性</option>
                    <option value="3" {{ ($searchParams['gender'] ?? '') == '3' ? 'selected' : '' }}>その他</option>
                </select>
            </div>

            <!-- 問い合わせの種類 -->
            <div class="admin__search--icon">
                <select class="admin__search-select" name="category_id">
                    <option value="">お問い合わせの種類</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category['id'] }}"
                            {{ ($searchParams['category_id'] ?? '') == $category['id'] ? 'selected' : '' }}>
                            {{ $category['content'] }}</option>
                    @endforeach
                </select>
            </div>

            <!-- 日付 -->
            <div class="admin__search--icon">
                <input type="date" class="admin__date-input" name="date" value="{{ $searchParams['date'] ?? '' }}">
            </div>

            <!-- 検索、リセットボタン -->
            <button type="submit" class="admin__search-btn">検索</button>
            <a href="/admin/reset" class="admin__reset-btn">リセット</a>
        </form>

        <!-- エクスポート、ページネーション -->
        <div class="admin__actions">
            <form action="/admin/export" method="post">
                @csrf
                <button type="submit" class="admin__export-btn">エクスポート</button>
            </form>
            <div class="admin__pagination--web">
                {{ $contacts->links('pagination.custom') }}
            </div>
        </div>

        <!-- 取得データ表示 -->
        <div class="admin__table-wrapper">
            <table class="admin__table">
                <thead class="admin__table-head">
                    <tr class="admin__table-row admin__table-row--header">
                        <th class="admin__table-header">お名前</th>
                        <th class="admin__table-header">性別</th>
                        <th class="admin__table-header">メールアドレス</th>
                        <th class="admin__table-header">お問い合わせの種類</th>
                        <th class="admin__table-header"></th>
                    </tr>
                </thead>
                <tbody class="admin__table-body">
                    @foreach ($contacts as $contact)
                        <tr class="admin__table-row">
                            <td class="admin__table-cell">
                                {{ $contact['last_name'] . ' ' . $contact['first_name'] }}
                            </td>
                            <td class="admin__table-cell">
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
                            </td>
                            <td class="admin__table-cell">{{ $contact['email'] }}</td>
                            <td class="admin__table-cell">{{ $contact['category']['content'] }}</td>
                            <td class="admin__table-cell">
                                <a href="#modal-{{ $loop->index }}" class="admin__detail-btn">詳細</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- レスポンシブ用カードデザイン -->
    <div class="card-container">
        @foreach ($contacts as $index => $contact)
            <div class="card">
                <div class="card__header">
                    <div class="card__name">{{ $contact['last_name'] . ' ' . $contact['first_name'] }}</div>
                    <div class="card__gender">
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
                </div>
                <div class="card__body">
                    <div class="card__field">
                        <span class="card__label">メールアドレス</span>
                        <span class="card__value">{{ $contact['email'] }}</span>
                    </div>
                    <div class="card__field">
                        <span class="card__label">お問い合わせの種類</span>
                        <span class="card__value">{{ $contact['category']['content'] }}</span>
                    </div>
                </div>
                <div class="card__footer">
                    <a href="#modal-{{ $index }}" class="admin__detail-btn">詳細</a>
                </div>
            </div>
        @endforeach
    </div>

    <!-- レスポンシブ用ページネーション -->
    <div class="admin__pagination--mobile">
        {{ $contacts->links('pagination.custom') }}
    </div>

    <!-- モーダルデザイン -->
    @if ($contacts->isNotEmpty())
        @foreach ($contacts as $index => $contact)
            <div id="modal-{{ $index }}" class="modal">
                <div class="modal__content">
                    <a href="#" class="modal__close">&times;</a>
                    <div class="modal__form">
                        <div class="modal__form-row">
                            <label class="modal__form-label">お名前</label>
                            <span
                                class="modal__form-value">{{ $contact['last_name'] . ' ' . $contact['first_name'] }}</span>
                        </div>
                        <div class="modal__form-row">
                            <label class="modal__form-label">性別</label>
                            <span class="modal__form-value">
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
                            </span>
                        </div>
                        <div class="modal__form-row">
                            <label class="modal__form-label">メールアドレス</label>
                            <span class="modal__form-value">{{ $contact['email'] }}</span>
                        </div>
                        <div class="modal__form-row">
                            <label class="modal__form-label">電話番号</label>
                            <span class="modal__form-value">{{ $contact['tel'] }}</span>
                        </div>
                        <div class="modal__form-row">
                            <label class="modal__form-label">住所</label>
                            <span class="modal__form-value">{{ $contact['address'] }}</span>
                        </div>
                        <div class="modal__form-row">
                            <label class="modal__form-label">建物名</label>
                            <span class="modal__form-value">{{ $contact['building'] }}</span>
                        </div>
                        <div class="modal__form-row">
                            <label class="modal__form-label">お問い合わせの種類</label>
                            <span class="modal__form-value">{{ $contact['category']['content'] }}</span>
                        </div>
                        <div class="modal__form-row">
                            <label class="modal__form-label">お問い合わせ内容</label>
                            <span class="modal__form-value">{{ $contact['detail'] }}</span>
                        </div>
                        <form class="delete-form" action="/admin/delete" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $contact['id'] }}">
                            <button type="submit" class="delete-btn">削除</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
@endsection

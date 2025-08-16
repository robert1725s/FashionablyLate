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
        <div class="admin__search-list">
            <form class="admin__search" action="/admin/search" method="post">
                @csrf
                <input type="text" name="keyword" class="admin__search-input" placeholder="名前やメールアドレスを入力してください"
                    value="{{ $searchParams['keyword'] ?? '' }}">
                <div class="admin__search--icon">
                    <select class="admin__search-select admin__search-select--gender" name="gender">
                        <option value="">性別</option>
                        <option value="1" {{ ($searchParams['gender'] ?? '') == '1' ? 'selected' : '' }}>男性</option>
                        <option value="2" {{ ($searchParams['gender'] ?? '') == '2' ? 'selected' : '' }}>女性</option>
                        <option value="3" {{ ($searchParams['gender'] ?? '') == '3' ? 'selected' : '' }}>その他</option>
                    </select>
                </div>
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
                <div class="admin__search--icon">
                    <input type="date" class="admin__date-input" name="date"
                        value="{{ $searchParams['date'] ?? '' }}">
                </div>
                <button type="submit" class="admin__search-btn">検索</button>
            </form>
            <form action="/admin/reset" method="post" class="admin__reset-form">
                @csrf
                <button type="submit" class="admin__reset-btn">リセット</button>
            </form>
        </div>

        <div class="admin__actions">
            <form action="/admin/export" method="post">
                @csrf
                <button type="submit" class="admin__export-btn">エクスポート</button>
            </form>
            <div class="admin__pagination">
                {{ $contacts->links('pagination.custom') }}
            </div>
        </div>

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

    @if ($contacts->isNotEmpty())
        @foreach ($contacts as $index => $contact)
            <div id="modal-{{ $index }}" class="modal">
                <div class="modal-content">
                    <a href="#" class="modal-close">&times;</a>
                    <div class="modal-form">
                        <div class="form-row">
                            <label class="form-label">お名前</label>
                            <span class="form-value">{{ $contact['last_name'] . ' ' . $contact['first_name'] }}</span>
                        </div>
                        <div class="form-row">
                            <label class="form-label">性別</label>
                            <span class="form-value">
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
                        <div class="form-row">
                            <label class="form-label">メールアドレス</label>
                            <span class="form-value">{{ $contact['email'] }}</span>
                        </div>
                        <div class="form-row">
                            <label class="form-label">電話番号</label>
                            <span class="form-value">{{ $contact['tel'] }}</span>
                        </div>
                        <div class="form-row">
                            <label class="form-label">住所</label>
                            <span class="form-value">{{ $contact['address'] }}</span>
                        </div>
                        <div class="form-row">
                            <label class="form-label">建物名</label>
                            <span class="form-value">{{ $contact['building'] }}</span>
                        </div>
                        <div class="form-row">
                            <label class="form-label">お問い合わせの種類</label>
                            <span class="form-value">{{ $contact['category']['content'] }}</span>
                        </div>
                        <div class="form-row">
                            <label class="form-label">お問い合わせ内容</label>
                            <span class="form-value">{{ $contact['detail'] }}</span>
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

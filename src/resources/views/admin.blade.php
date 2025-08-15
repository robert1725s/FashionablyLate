@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
@endsection

@section('button')
    <a href="/login" class="logout-btn">logout</a>
@endsection

@section('page-title')
    Admin
@endsection

@section('content')
    <div class="admin__container">
        <div class="admin__search">
            <input type="text" class="admin__search-input" placeholder="名前やメールアドレスを入力してください">
            <div class="admin__search--icon">
                <select class="admin__search-select admin__search-select--gender">
                    <option value="">性別</option>
                    <option value="1">男性</option>
                    <option value="2">女性</option>
                    <option value="3">その他</option>
                </select>
            </div>
            <div class="admin__search--icon">
                <select class="admin__search-select">
                    <option value="">お問い合わせの種類</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category['id'] }}">
                            {{ $category['content'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="admin__search--icon">
                <input type="date" class="admin__date-input" name="date">
            </div>
            <button class="admin__search-btn">検索</button>
            <button class="admin__reset-btn">リセット</button>
        </div>

        <div class="admin__actions">
            <button class="admin__export-btn">エクスポート</button>
            <div class="admin__pagination">
                {{ $contacts->links() }}
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
                                {{ $contact['last_name'] . '　' . $contact['first_name'] }}
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
                                <button class="admin__detail-btn">詳細</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@if ($paginator->hasPages())
    <nav aria-label="ページネーション" class="pagination-wrapper">
        <ul class="custom-pagination">
            <!-- 前へボタン -->
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link prev">&lt;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link prev" href="{{ $paginator->previousPageUrl() }}" rel="prev">&lt;</a>
                </li>
            @endif

            <!-- ページ番号ボタン -->
            @foreach ($elements as $element)
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active">
                                <span class="page-link current">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link number" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            <!-- 次へボタン -->
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link next" href="{{ $paginator->nextPageUrl() }}" rel="next">&gt;</a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link next">&gt;</span>
                </li>
            @endif
        </ul>
    </nav>

    <style>
        .custom-pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            list-style: none;
            padding: 0;
            margin: 0;
            border-radius: 8px;
            max-width: 500px;
            margin: 0 auto;
        }

        .custom-pagination .page-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            text-decoration: none;
            border: none;
            font-size: 16px;
            line-height: 1;
        }

        /* アクティブページ（現在のページ） */
        .custom-pagination .page-item.active .page-link.current {
            background-color: #8B7969;
            color: white;
            font-weight: 600;
            border: none;
        }

        /* 通常のページ番号 */
        .custom-pagination .page-link.number {
            background-color: white;
            color: #8B7355;
            border-top: 1px solid #E0DFDE;
            border-bottom: 1px solid #E0DFDE;
            border-left: 1px solid #E0DFDE;
        }

        .custom-pagination .page-link.number:hover {
            background-color: #f5f5f5;
            color: #6D5A44;
            transform: translateY(-1px);
        }

        /* 前へ・次へボタン */
        .custom-pagination .page-link.prev,
        .custom-pagination .page-link.next {
            background-color: white;
            color: #8B7355;
            border-top: 1px solid #E0DFDE;
            border-bottom: 1px solid #E0DFDE;
            border-left: 1px solid #E0DFDE;
            font-size: 18px;
            font-weight: bold;
            line-height: 1;
        }

        .custom-pagination .page-link.prev {
            border-top-left-radius: 6px;
            border-bottom-left-radius: 6px;
        }

        .custom-pagination .page-link.next {
            border-right: 1px solid #E0DFDE;
            border-top-right-radius: 6px;
            border-bottom-right-radius: 6px;
        }

        .custom-pagination .page-link.prev:hover,
        .custom-pagination .page-link.next:hover {
            background-color: #f5f5f5;
            color: #6D5A44;
            transform: translateY(-1px);
        }

        /* 無効状態 */
        .custom-pagination .page-item.disabled .page-link {
            cursor: not-allowed;
            color: #ccc;
        }

        .custom-pagination .page-item.disabled .page-link:hover {
            background-color: white;
            transform: none;
            color: #ccc;
        }

        /* レスポンシブ対応 */
        @media (max-width: 576px) {
            .custom-pagination .page-link {
                width: 35px;
                height: 35px;
                font-size: 14px;
            }

            .custom-pagination .page-link.prev,
            .custom-pagination .page-link.next {
                font-size: 16px;
            }

            .custom-pagination {
                padding: 6px;
            }
        }
    </style>
@endif

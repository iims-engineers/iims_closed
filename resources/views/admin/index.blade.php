<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>管理画面TOP</title>
    @include('components.head')
    {{-- 暫定対応のためスタイル直書き --}}
    <style>
        .link-top {
            margin-bottom: 10px;
        }

        .p-sub__inner {
            font-weight: bold;
        }
    </style>
</head>

<body class="is-subpage">
    <div class="l-container">

        <!-- l-header START -->
        <!-- l-header END -->

        <div class="l-contents">
            <main class="l-main">
                <section class="p-sub__section">
                    <h1 class="p-sub__head01">管理画面TOP</h1>
                    <div class="p-sub__inner link-top">
                        <p>
                            <a href="{{ route('admin.show.unapproved.list') }}">▪️承認待ちユーザー一覧</a>
                        </p>
                    </div>
                    <div class="p-sub__inner">
                        <p>
                            <a href="{{ route('admin.show.support.list') }}">▪️メッセージ一覧</a>
                        </p>
                    </div>
                </section>
            </main>
            <!-- l-footer START -->
            @include('components.l-footer-top')
            <!-- l-footer END -->
        </div>
    </div>
    @include('components.javascript')
</body>

</html>
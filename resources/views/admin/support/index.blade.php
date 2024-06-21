<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>メッセージ一覧</title>
    @include('components.head')
</head>

<body class="is-subpage">
    <div class="l-container">

        <!-- l-header START -->
        <!-- l-header END -->

        <div class="l-contents">
            <main class="l-main">
                <section class="p-sub__section">
                    <h1 class="p-sub__head01">メッセージ一覧</h1>
                    <div class="p-sub__inner">
                        @forelse($messages as $message)
                        <div class="c-user">
                            <p>送信者：{{ data_get($message, 'username') }}</p>
                            <p>送信日時：{{ data_get($message, 'created_at') }}</p>
                            <p>送信内容：{!! nl2br(htmlspecialchars(data_get($message, 'message'))) !!}</p>
                        </div>
                        @empty
                        <p>現在表示できるメッセージはありません。</p>
                        @endforelse
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
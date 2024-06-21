<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>お知らせ一覧</title>
    @include('components.head')
</head>

<body class="is-subpage">
    <div class="l-container">

        <!-- l-header START -->
        @include('components.l-header')
        <!-- l-header END -->

        <div class="l-contents">
            <main class="l-main">
                <section class="p-sub__section">
                    <h1 class="p-sub__head01">お知らせ一覧</h1>
                    <a href="{{ route('admin.show.announcement.create') }}">★新規作成はこちら★</a>
                    <div class="p-sub__inner">
                        @if(!empty($announcement_list))
                        @foreach($announcement_list as $announcement)
                        <div class="c-announcement">
                            <p>【タイトル】<br>
                                {{ data_get($announcement, 'title') }}
                            </p>
                            <p>【本文】<br>
                                {!! nl2br(htmlspecialchars(data_get($announcement, 'content'))) !!}
                            </p>
                            <p>【公開開始日】{{ data_get($announcement, 'pub_start_at') }}</p>
                            <p>【公開終了日】{{ data_get($announcement, 'pub_end_at') }}</p>
                            <p>【公開状況】{{ data_get($announcement, 'pub_status') }}</p>
                            <p>---------------------------------------</p>
                        </div>
                        @endforeach
                        @else
                        <p>現在表示できるお知らせはありません。</p>
                        @endif
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
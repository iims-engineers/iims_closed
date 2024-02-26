<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>個人設定</title>
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
                    <h1 class="p-sub__head01">ユーザー詳細：{{ Arr::get($user, 'name') }}さん</h1>
                    <div class="p-sub__inner">
                        <div>
                            <p>氏名：{{ Arr::get($user, 'name') }}</p>
                            <p>カナ：{{ Arr::get($user, 'name_kana') }}</p>
                            <p>生年月日：{{ Arr::get($user, 'birthday') }} ※表示設定がある場合のみ</p>
                            <p>国籍：{{ Arr::get($user, 'nationality') }}</p>
                            <p>自己紹介テキスト：{{ Arr::get($user, 'introduction_text') }}</p>
                            <p>過去の活動参加歴：{{ Arr::get($user, 'past_join') }}</p>
                        </div>
                    </div>
        </div>
        </section>
        </main>
        <!-- l-footer START -->
        @include('components.l-footer')
        <!-- l-footer END -->
    </div>
    </div>
    @include('components.javascript')
</body>

</html>
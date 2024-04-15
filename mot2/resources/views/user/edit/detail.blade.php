<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>ユーザー詳細</title>
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
                            <p>イニシャル：{{ Arr::get($user, 'initial') }} ※非公開アカウントは氏名ではなくイニシャルを表示</p>
                            <p>生年月日：{{ Arr::get($user, 'birthday') }} ※表示設定がある場合のみ(年齢に変換して表示する?)</p>
                            <p>国籍：{{ Arr::get($user, 'nationality') }}</p>
                            <p>自己紹介テキスト：{!! nl2br(htmlspecialchars(Arr::get($user, 'introduction_text'))) !!}</p>
                            <p>過去の活動参加歴：{!! nl2br(htmlspecialchars(Arr::get($user, 'past_join'))) !!}</p>
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
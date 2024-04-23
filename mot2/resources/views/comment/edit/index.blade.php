<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>この回答を編集</title>
    @include('components.head')
</head>

<body class="is-subpage">
    <div class="l-container">

        <!-- l-header START -->
        @include('components.header')
        <!-- l-header END -->

        <div class="l-contents">
            <main class="l-main">
                <section class="p-sub__section">
                    <h1 class="p-sub__head01">この回答を編集</h1>
                    <div class="p-sub__inner">
                        <div class="c-user no-link">
                            <div class="c-user-icon">
                                <!-- <img src="{{ data_get($topic, 'user_icon') }}" alt=""> -->
                                <img src="/img/common/dummy_icon.png" alt="">
                            </div>
                            <div class="c-user-info">
                                <div class="c-user-name">{{ data_get($topic, 'name') }}</div>
                                <div class="c-user-id">@ {{ data_get($topic, 'user_identifier') }}</div>
                            </div>
                        </div>
                        <div class="c-topic-detail">
                            <p>
                                {!! nl2br(htmlspecialchars(data_get($topic, 'content'))) !!}
                            </p>
                            <time class="c-topic-date" datetime="{{ data_get($topic, 'created_at') }}">{{ data_get($topic, 'created_at') }}</time>
                            <time class="c-reply-date" datetime="{{ data_get($topic, 'updated_at') }}">{{ data_get($topic, 'updated_at') }}</time>
                        </div>
                        <div class="c-reply-wrap">
                            <div class="c-reply c-reply--has-detail">
                                <div class="c-user no-link">
                                    <div class="c-user-icon">
                                        <img src="/img/common/dummy_icon.png" alt="">
                                    </div>
                                    <div class="c-user-info">
                                        <div class="c-user-name">もっと太郎</div>
                                        <div class="c-user-id">@username</div>
                                    </div>
                                </div>
                                <div class="c-reply-detail">
                                    <p>
                                        まじで俺もビックリだわ〜笑<br>
                                        username終電までいる予定だって！
                                    </p>
                                    <time class="c-reply-date" datetime="2024-11-11T15:00:33">2024/11/11 15:00:33</time>
                                </div>
                            </div>
                            <div class="c-reply c-reply--has-detail">
                                <div class="c-user no-link">
                                    <div class="c-user-icon">
                                        <img src="/img/common/dummy.png" alt="">
                                    </div>
                                    <div class="c-user-info">
                                        <div class="c-user-name">もっと太郎</div>
                                        <div class="c-user-id">@username</div>
                                    </div>
                                </div>
                                <div class="c-reply-detail">
                                    <p>
                                        まじで俺もビックリだわ〜笑<br>
                                        username終電までいる予定だって！
                                    </p>
                                    <time class="c-reply-date" datetime="2024-11-11T15:00:33">2024/11/11 15:00:33</time>
                                    <div class="c-reply-edit">
                                        <a href="" class="c-button--mini">
                                            <img src="/img/common/icon-pencil.svg" alt="">
                                            <span>回答を編集</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="c-reply c-reply--has-detail">
                                <form action="" class="c-form" style="width: 100%;">
                                    <div class="c-form-item">
                                        <div class="c-user no-link">
                                            <div class="c-user-icon">
                                                <img src="/img/common/dummy.png" alt="">
                                            </div>
                                            <div class="c-user-info">
                                                <div class="c-user-name">もっと太郎</div>
                                                <div class="c-user-id">@username</div>
                                            </div>
                                        </div>
                                        <textarea name="comment" id="comment" cols="30" rows="10">まじで俺もビックリだわ〜笑&NewLine;username終電までいる予定だって！</textarea>
                                    </div>
                                    <div class="c-form-submit c-button-wrap">
                                        <button type="submit" class="c-button">更新する</button>
                                    </div>
                                </form>
                            </div>
                            <div class="c-reply c-reply--has-detail">
                                <div class="c-user no-link">
                                    <div class="c-user-icon">
                                        <img src="/img/common/dummy_icon.png" alt="">
                                    </div>
                                    <div class="c-user-info">
                                        <div class="c-user-name">もっと太郎</div>
                                        <div class="c-user-id">@username</div>
                                    </div>
                                </div>
                                <div class="c-reply-detail">
                                    <p>
                                        まじで俺もビックリだわ〜笑<br>
                                        username終電までいる予定だって！
                                    </p>
                                    <time class="c-reply-date" datetime="2024-11-11T15:00:33">2024/11/11 15:00:33</time>
                                    <time class="c-reply-date" datetime="2024-11-11T15:00:33">（更新：2024/11/11 15:00:33）</time>
                                </div>
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
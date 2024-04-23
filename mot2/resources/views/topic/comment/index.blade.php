<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>このトピックに回答</title>
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
                    <h1 class="p-sub__head01">このトピックに回答</h1>
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
                            <time class="c-reply-date" datetime="{{ data_get($topic, 'updated_at') }}">（更新：{{ data_get($topic, 'updated_at') }}）</time>
                        </div>
                        {{-- トピックここまで --}}
                        {{-- ここからコメント --}}
                        <div class="c-reply-wrap">
                            @if($comments->isNotEmpty())
                            @foreach($comments as $comment)
                            <div class="c-reply c-reply--has-detail">
                                <div class="c-user no-link">
                                    <div class="c-user-icon">
                                        <!-- <img src="{{ data_get($comment, 'user_icon', '') }}" alt=""> -->
                                        <img src="/img/common/dummy_icon.png" alt="">
                                    </div>
                                    <div class="c-user-info">
                                        <div class="c-user-name">{{ data_get($comment, 'username') }}</div>
                                        <div class="c-user-id">@ {{ data_get($comment, 'user_identifier') }}</div>
                                    </div>
                                </div>
                                <div class="c-reply-detail">
                                    <p>
                                        まじで俺もビックリだわ〜笑<br>
                                        username終電までいる予定だって！
                                    </p>
                                    <time class="c-reply-date" datetime="{{ data_get($comment, 'created_at') }}">{{ data_get($comment, 'created_at') }}</time>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                        <form action="" class="c-form" style="margin: 40px 0 0;">
                            <div class="c-form-item">
                                <div class="c-user no-link">
                                    <div class="c-user-icon">
                                        <!-- <img src="{{ data_get($user, 'user_icon', '') }}" alt=""> -->
                                        <img src="/img/common/dummy.png" alt="">
                                    </div>
                                    <div class="c-user-info">
                                        <div class="c-user-name">{{ data_get($user, 'name') }}</div>
                                        <div class="c-user-id">@ {{ data_get($user, 'user_identifier') }}</div>
                                    </div>
                                </div>
                                <textarea name="comment" id="comment" cols="30" rows="10"></textarea>
                            </div>
                            <div class="c-form-submit c-button-wrap">
                                <button type="submit" class="c-button">回答する</button>
                            </div>
                        </form>
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
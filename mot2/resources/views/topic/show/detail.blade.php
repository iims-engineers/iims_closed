<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <title>トピックの詳細</title>
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
          <h1 class="p-sub__head01">トピックの詳細</h1>
          @if(session('flash_message'))
          <div class="form-error">
            <p class="error-text">{{ session('flash_message') }}</p>
          </div>
          @endif
          <div class="p-sub__inner">
            <div class="c-user">
              <div class="c-user-icon">
                <img src="/img/common/dummy_icon.png" alt="">
              </div>
              <div class="c-user-info">
                <div class="c-user-name">{{ $topic->name }}</div>
              </div>
            </div>
            <div class="c-topic-detail">
              <p>{!! nl2br(htmlspecialchars($topic->content)) !!}</p>
              <time class="c-topic-date" datetime="{{ $topic->created_at }}">{{ $topic->created_at }}</time>
            </div>
            <div class="c-button-wrap">
              <a href="" class="c-button">
                <img src="/img/common/icon-reply.svg" alt="">
                <span>このトピックに回答する</span>
              </a>
              @if(Auth::user()->id === $topic->user_id)
              <a href="{{ route('topic.delete', ['id' => $topic->id]) }}" class="c-button">
                <img src="/img/common/icon-reply.svg" alt="">
                <span>このトピックを削除する</span>
              </a>
              @endif
            </div>
            <div class="c-reply-wrap">
              <div class="c-reply c-reply--has-detail">
                <div class="c-user">
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
                <div class="c-user">
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
                </div>
              </div>
              <div class="c-reply c-reply--has-detail">
                <div class="c-user">
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
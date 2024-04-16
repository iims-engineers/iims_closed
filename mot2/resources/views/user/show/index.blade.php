<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <title>{{ Arr::get($user, 'name') }}さんのページ</title>
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
          <h1 class="p-sub__head01">{{ Arr::get($user, 'name') }}さんのページ</h1>
          <div class="p-sub__inner is-user-info">
            <div class="c-user-info__cover">
              <img src="/img/common/dummy.png" alt="">
            </div>
            <div class="c-user-info__head">
              <div class="c-user-icon">
                <img src="/img/common/dummy.png" alt="">
              </div>
              <div class="c-user-info">
                <div class="c-user-name">{{ Arr::get($user, 'name') }}</div>
                <div class="c-user-id">{{ Arr::get($user, 'user_identifier') }}</div>
              </div>
            </div>
            <div class="c-user-info__body">
              {!! nl2br(htmlspecialchars(Arr::get($user, 'introduction_text'))) !!}
            </div>
            <div class="c-user-info__foot">
              <div class="c-user__sns">
                <div class="c-user__sns-item">
                  <a href="{{ Arr::get($user, 'sns_x') }}" target="_blank">
                    <img src="/img/common/icon_circle_x.svg" alt="X">
                  </a>
                </div>
                <div class="c-user__sns-item">
                  <a href="{{ Arr::get($user, 'sns_facebook') }}" target="_blank">
                    <img src="/img/common/icon_circle_facebook.svg" alt="X">
                  </a>
                </div>
                <div class="c-user__sns-item">
                  <a href="{{ Arr::get($user, 'sns_instagram') }}" target="_blank">
                    <img src="/img/common/icon_circle_instagram.svg" alt="X">
                  </a>
                </div>
              </div>
            </div>
          </div>
        </section>

        <section class="p-sub__section">
          <h2 class="p-sub__head02">{{ Arr::get($user, 'name') }}さんのトピック一覧</h2>
          @if($topics->isEmpty())
          <p>現在表示できるトピックはありません。</p>
          @else
          @foreach($topics as $topic)
          <div class="c-topic-wrap">
            <a href="/topic/show/topicID/" class="c-topic-title js-accordion-topic">{{ $topic->title }}</a>
            <div class="p-sub__inner">
              <div class="c-user">
                <a href="/user/show/user-id/">
                  <div class="c-user-icon">
                    <img src="/img/common/dummy_icon.png" alt="">
                  </div>
                  <div class="c-user-info">
                    <div class="c-user-name">{{ $topic->name }}</div>
                    <div class="c-user-id">@ {{ $topic->user_id }}</div>
                  </div>
                </a>
              </div>
              <div class="c-topic-detail">
                <p>
                  {!! nl2br(htmlspecialchars($topic->content)) !!}
                </p>
                <time class="c-topic-date" datetime="{{ $topic->created_at }}">{{ $topic->created_at }}</time>
              </div>
              <div class="c-button-wrap">
                <a href="" class="c-button">
                  <img src="/img/common/icon-reply.svg" alt="">
                  <span>このトピックに回答する</span>
                </a>
                <a href="/topic/" class="c-button">
                  <img src="/img/common/icon-show-topic.svg" alt="">
                  <span>このトピックを見る</span>
                </a>
                <a href="" class="c-button">
                  <img src="/img/common/icon-pencil.svg" alt="">
                  <span>このトピックを編集する</span>
                </a>
              </div>
            </div>
          </div>
          @endforeach
          @endif
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
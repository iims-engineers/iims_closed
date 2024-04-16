<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <title>トピックの一覧</title>
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
          <h1 class="p-sub__head01">トピック一覧</h1>
          @if($topics->isEmpty())
          <p>現在表示できるトピックはありません。</p>
          @else
          @foreach($topics as $topic)
          <div class="c-topic-wrap">
            <a href="{{ route('topic.show.detail', ['id' => $topic->id]) }}" class="c-topic-title js-accordion-topic">{{ $topic->title }}</a>
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
                <a href="/topic/comment/topicsID/" class="c-button">
                  <img src="/img/common/icon-reply.svg" alt="">
                  <span>このトピックに回答する</span>
                </a>
                <a href="{{ route('topic.show.detail', ['id' => $topic->id]) }}" class="c-button">
                  <img src="/img/common/icon-show-topic.svg" alt="">
                  <span>このトピックを見る</span>
                </a>
                <a href="/topic/edit/topicsID/" class="c-button">
                  <img src="/img/common/icon-pencil.svg" alt="">
                  <span>このトピックを編集する</span>
                </a>
              </div>
            </div>
          </div>
          @endforeach
          @endif
          <div class="c-pagenation">
            <a href="" class="c-pagenation-item">＜ 前のページ</a>
            <a href="" class="c-pagenation-item">次のページ ＞</a>
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
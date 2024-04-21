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
          <h1 class="p-sub__head01">トピック一覧　(全{{ $total_cnt }}件)</h1>
          @if(empty($topics))
          <p>現在表示できるトピックはありません。</p>
          @else
          @foreach($topics as $topic)
          <div class="c-topic-wrap">
            <a href="{{ route('topic.show.detail', ['id' => data_get($topic, 'id')]) }}" class="c-topic-title js-accordion-topic">{{ data_get($topic, 'title') }}</a>
            <div class="p-sub__inner">
              <div class="c-user">
                <a href="/user/show/user-id/">
                  <div class="c-user-icon">
                    <!-- <img src="{{ data_get($topic, 'user_icon') }}" alt=""> -->
                    <img src="/img/common/dummy_icon.png" alt="">
                  </div>
                  <div class="c-user-info">
                    <div class="c-user-name">{{ data_get($topic, 'name') }}</div>
                    <div class="c-user-id">@ {{ data_get($topic, 'user_identifier') }}</div>
                  </div>
                </a>
              </div>
              <div class="c-topic-detail">
                <p>
                  {!! nl2br(htmlspecialchars(data_get($topic, 'content'))) !!}
                </p>
                <time class="c-topic-date" datetime="{{ data_get($topic, 'created_at') }}">{{ data_get($topic, 'created_at') }}</time>
              </div>
              <div class="c-button-wrap">
                <a href="/topic/comment/topicsID/" class="c-button">
                  <img src="/img/common/icon-reply.svg" alt="">
                  <span>このトピックに回答する</span>
                </a>
                <a href="{{ route('topic.show.detail', ['id' => data_get($topic, 'id')]) }}" class="c-button">
                  <img src="/img/common/icon-show-topic.svg" alt="">
                  <span>このトピックを見る</span>
                </a>
                {{-- 編集できるのは作成者のみ --}}
                @if(data_get($topic, 'user_id') === $user_id)
                <a href="{{ route('topic.show.edit', ['id' => data_get($topic, 'id')]) }}" class="c-button">
                  <img src="/img/common/icon-pencil.svg" alt="">
                  <span>このトピックを編集する</span>
                </a>
                @endif
              </div>
            </div>
          </div>
          @endforeach
          @endif
          <div class="c-pagenation">
            @if($page > 1)
            <a href="{{ route('topic.show.list', ['page' => $page_previous]) }}" class="c-pagenation-item">＜ 前のページ</a>
            @endif
            @if(!empty($page_next))
            <a href="{{ route('topic.show.list', ['page' => $page_next]) }}" class="c-pagenation-item">次のページ ＞</a>
            @endif
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
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
          <p class="c-topic-title">{{ data_get($topic, 'title') }}</p>
          <div class="p-sub__inner">
            <div class="c-user no-link">
              <div class="c-user-icon">
                @if(!empty(data_get($topic, 'user_icon')))
                <img src="{{ asset('storage/'. data_get($topic, 'user_icon')) }}" alt="">
                @else
                <img src="/img/common/dummy_icon.png" alt="">
                @endif
              </div>
              <div class="c-user-info">
                <div class="c-user-name">{{ data_get($topic, 'name') }}</div>
                <div class="c-user-id">@ {{ data_get($topic, 'user_identifier') }}</div>
              </div>
            </div>
            <div class="c-topic-detail">
              <p>
                {!! nl2br(data_get($topic, 'content')) !!}
              </p>
              <time class="c-topic-date" datetime="{{ data_get($topic, 'created_at') }}">{{ data_get($topic, 'created_at') }}</time>
              @if(strtotime(data_get($topic, 'created_at')) !== strtotime(data_get($topic, 'updated_at')))
              <time class="c-topic-date" datetime="{{ data_get($topic, 'updated_at') }}">（更新：{{ data_get($topic, 'updated_at') }}）</time>
              @endif
            </div>
            {{-- トピックここまで --}}
            {{-- ここからコメント --}}
            <div class="c-reply-wrap">
              @if($comments->isNotEmpty())
              @foreach($comments as $comment)
              <div class="c-reply c-reply--has-detail">
                <div class="c-user no-link">
                  <div class="c-user-icon">
                    @if(!empty(data_get($comment, 'user_icon')))
                    <img src="{{ asset('storage/'. data_get($comment, 'user_icon')) }}" alt="">
                    @else
                    <img src="/img/common/dummy_icon.png" alt="">
                    @endif
                  </div>
                  <div class="c-user-info">
                    <div class="c-user-name">{{ data_get($comment, 'username') }}</div>
                    <div class="c-user-id">@ {{ data_get($comment, 'user_identifier') }}</div>
                  </div>
                </div>
                <div class="c-reply-detail">
                  <p>
                    {!! nl2br(htmlspecialchars(data_get($comment, 'comment'))) !!}
                  </p>
                  <time class="c-reply-date" datetime="{{ data_get($comment, 'created_at') }}">{{ data_get($comment, 'created_at') }}</time>
                  @if(strtotime(data_get($comment, 'created_at')) !== strtotime(data_get($comment, 'updated_at')))
                  <time class="c-reply-date" datetime="{{ data_get($comment, 'updated_at') }}">（更新：{{ data_get($comment, 'updated_at') }}）</time>
                  @endif
                  @if(data_get($comment, 'user_id') === data_get($user, 'id'))
                  <div class="c-reply-edit">
                    <a href="{{ route('comment.show.edit', ['comment_id' => data_get($comment, 'id')]) }}" class="c-button--mini">
                      <img src="/img/common/icon-pencil.svg" alt="">
                      <span>回答を編集</span>
                    </a>
                  </div>
                  @endif
                </div>
              </div>
              @endforeach
              @endif
            </div>
            <form action="{{ route('comment.store') }}" method="POST" class="c-form" style="margin: 40px 0 0;">
              @csrf
              <div class="c-form-item">
                <div class="c-user no-link">
                  <div class="c-user-icon">
                    @if(!empty(data_get($user, 'user_icon')))
                    <img src="{{ asset('storage/'. data_get($user, 'user_icon')) }}" alt="">
                    @else
                    <img src="/img/common/dummy_icon.png" alt="">
                    @endif
                  </div>
                  <div class="c-user-info">
                    <div class="c-user-name">{{ data_get($user, 'name') }}</div>
                    <div class="c-user-id">@ {{ data_get($user, 'user_identifier') }}</div>
                  </div>
                </div>
                <textarea name="comment" id="comment" cols="30" rows="10"></textarea>
                @error('comment')
                <p class="error-text">※{{ $message }}</p>
                @enderror
                <input type="hidden" name="topic_id" value="{{ data_get($topic, 'id') }}">
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
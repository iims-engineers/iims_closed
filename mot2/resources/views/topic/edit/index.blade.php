<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <title>このトピックを編集</title>
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
          <h1 class="p-sub__head01">このトピックを編集</h1>
          <div class="p-sub__inner">
            <form action="{{ route('topic.store') }}" method="POST" class="c-form" style="margin: 0;">
              @csrf
              <div class="c-form-item">
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
                <textarea name="topic-detail" id="topic-detail" cols="30" rows="10">{!! nl2br(htmlspecialchars(data_get($topic, 'content'))) !!}</textarea>
                <input type="hidden" name="topic-id" value="{{ data_get($topic, 'id') }}">
                <input type="hidden" name="topic-title" value="{{ data_get($topic, 'title') }}">
              </div>
              <div class="c-form-submit c-button-wrap">
                <button type="submit" class="c-button">更新する</button>
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
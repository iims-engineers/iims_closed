<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <title>トピックの新規作成</title>
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
          <h1 class="p-sub__head01">トピックの新規作成</h1>
          <div class="p-sub__inner">
            <div class="c-user">
              <div class="c-user-icon">
                <img src="/img/common/dummy_icon.png" alt="">
              </div>
              <div class="c-user-name">username</div>
            </div>
            <form action="" class="c-form">
              <div class="c-form-item">
                <label for="topic-title" class="c-form-item-title">トピックのタイトル</label>
                <input type="text" name="topic-title" id="topic-title">
              </div>
              <div class="c-form-item">
                <label for="topic-detail" class="c-form-item-title">トピックの本文</label>
                <textarea name="topic-detail" id="topic-detail" cols="30" rows="10"></textarea>
              </div>
              <div class="c-form-submit c-button-wrap">
                <button type="submit" class="c-button">新規作成する</button>
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
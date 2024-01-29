<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <title>ユーザー一覧</title>
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
          <h1 class="p-sub__head01">ユーザー一覧</h1>
          <div class="p-sub__inner">
            <div class="c-user">
              <div class="c-user-icon">
                <img src="{{ ('/img/common/dummy_icon.png') }}" alt="">
              </div>
              <div class="c-user-info">
                <div class="c-user-name">もっと太郎</div>
                <div class="c-user-id">@username</div>
              </div>
            </div>
            <div class="c-user">
              <div class="c-user-icon">
                <img src="{{ ('/img/common/dummy_icon.png') }}" alt="">
              </div>
              <div class="c-user-info">
                <div class="c-user-name">もっと太郎</div>
                <div class="c-user-id">@username</div>
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
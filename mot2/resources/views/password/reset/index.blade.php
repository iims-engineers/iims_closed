<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <title>パスワードの再設定</title>
  @include('components.head')
</head>

<body class="p-top">
  <div class="l-container">

    <!-- l-header START -->
    @include('components.l-header-top')
    <!-- l-header END -->

    <div class="l-contents">
      <main class="l-main">
        <section class="p-sub__section">
          <h1 class="p-sub__head01">パスワードの再設定</h1>
          <div class="p-sub__lead">
            <p>
              新しいパスワードを設定してください。
            </p>
          </div>
          <form action="/home/" class="c-form">
            <div class="c-form-item">
              <label for="password" class="c-form-item-title">新しいパスワード</label>
              <input type="password" name="password" id="password">
            </div>
            <div class="c-form-item">
              <label for="password-check" class="c-form-item-title">パスワードを再度入力してください</label>
              <input type="password" name="password-check" id="password-check">
            </div>
            <div class="c-form-submit c-button-wrap">
              <button type="submit" class="c-button">設定する</button>
            </div>
          </form>
        </section>
      </main>
      <!-- l-footer START -->
      @include('components.l-footer-top')
      <!-- l-footer END -->
    </div>
  </div>
  @include('components.javascript')
</body>

</html>
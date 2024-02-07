<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <title>ログイン</title>
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
          <h1 class="p-sub__head01">ログイン</h1>
          <form action="" method='post' class="c-form">
            <div class="c-form-item">
              @csrf
              <label for="email" class="c-form-item-title">登録メールアドレス</label>
              <input type="email" name="email" id="email">
            </div>
            <div class="c-form-item">
              <label for="password" class="c-form-item-title">パスワード</label>
              <input type="password" name="password" id="password">
            </div>
            <div class="c-form-submit c-button-wrap">
              <button type="submit" class="c-button">ログイン</button>
            </div>
          </form>
        </section>
        <section class="p-sub__section">
          <h2 class="p-sub__head02">お困りですか？</h2>
          <div class="c-form-link">
            <a href="/password/mail-check/">パスワードを忘れた方はこちら</a>
            <a href="/apply/">ユーザー登録の申請はこちら</a>
          </div>
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
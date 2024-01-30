<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <title>パスワードのリセット</title>
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
          <h1 class="p-sub__head01">パスワードのリセット</h1>
          <div class="p-sub__lead">
            <p>
              登録いただいたメールアドレスを入力してください。パスワードリセット用のメールを送信いたします。<br>
              メール内に記載されているリンクをクリックして、パスワードの再設定を行ってください。
            </p>
            <p>
              メールが届かない場合は、該当のメールアドレスで登録がされていない可能性がございます。お手数ですが<a href="/apply/">こちら</a>よりユーザー登録の申請をし直してください。
            </p>
          </div>
          <form action="/password/mail-send/" class="c-form">
            <div class="c-form-item">
              <label for="email" class="c-form-item-title">登録メールアドレス</label>
              <input type="email" name="email" id="email">
            </div>
            <div class="c-form-submit c-button-wrap">
              <button type="submit" class="c-button">送信する</button>
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
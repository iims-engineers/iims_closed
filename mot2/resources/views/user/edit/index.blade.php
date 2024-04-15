<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <title>ユーザー情報編集</title>
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
          <h1 class="p-sub__head01">ユーザー情報編集</h1>
          <div class="p-sub__btns" style="margin: 0 0 20px;">
            <a href="{{ route('user.show.detail', ['id' => $user->id]) }}" class="c-button--large">
              <span>自分のプロフィールを見る</span>
            </a>
          </div>
          <div class="p-sub__inner">
            <form action="" class="c-form" style="margin: 10px 0 0;">
              @csrf
              <div class="c-form-item">
                <label for="user-icon" class="c-form-item-title">アイコン画像</label>
                <div class="c-form__icon-preview">
                  <img src="/img/common/dummy.png" alt="">
                </div>
                <input type="file" name="user-icon" id="user-icon">
              </div>
              <div class="c-form-item">
                <label for="user-name" class="c-form-item-title">ユーザー名</label>
                <input type="text" name="user-name" id="user-name" value="もっと太郎">
              </div>
              <div class="c-form-item">
                <label for="user-id" class="c-form-item-title">ユーザーID</label>
                <input type="text" name="user-id" id="user-id" value="username">
              </div>
              <div class="c-form-item">
                <label for="user-cover-image" class="c-form-item-title">プロフィールカバー画像</label>
                <div class="c-form__cover-preview">
                  <img src="/img/common/dummy.png" alt="">
                </div>
                <input type="file" name="user-cover-image" id="user-cover-image">
              </div>
              <div class="c-form-item">
                <label for="user-twitter" class="c-form-item-title">X（Twitter）アカウント</label>
                <input type="text" name="user-twitter" id="user-twitter" value="" placeholder="https://twitter.com/username">
              </div>
              <div class="c-form-item">
                <label for="user-fb" class="c-form-item-title">Facebookアカウント</label>
                <input type="text" name="user-fb" id="user-fb" value="" placeholder="https://www.facebook.com/username/">
              </div>
              <div class="c-form-item">
                <label for="user-insta" class="c-form-item-title">Instagramアカウント</label>
                <input type="text" name="user-insta" id="user-insta" value="" placeholder="https://www.instagram.com/username/">
              </div>
              <div class="c-form-item">
                <label for="user-intro" class="c-form-item-title">自己紹介文</label>
                <textarea name="user-intro" id="user-intro" cols="30" rows="10"></textarea>
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
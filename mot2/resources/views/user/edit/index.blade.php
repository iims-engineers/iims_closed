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
            <a href="{{ route('user.show.detail', ['id' => data_get($user, 'id')]) }}" class="c-button--large">
              <span>自分のプロフィールを見る</span>
            </a>
          </div>
          <div class="p-sub__inner">
            <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data" class="c-form" style="margin: 10px 0 0;">
              @csrf
              <div class="c-form-item">
                <label for="user_icon" class="c-form-item-title">アイコン画像</label>
                <div class="c-form__icon-preview">
                  @if(!empty(data_get($user, 'user_icon')))
                  <img src="{{ asset('storage/'. data_get($user, 'user_icon')) }}" alt="">
                  @else
                  <img src="/img/common/dummy_icon.png" alt="">
                  @endif
                </div>
                <input type="file" name="user_icon" id="user-icon" accept="image/png, image/jpeg, image/jpg">
                @error('user_icon')
                <p class="error-text">※{{ $message }}</p>
                @enderror
              </div>
              <div class="c-form-item">
                <label for="name" class="c-form-item-title">ユーザー名</label>
                <input type="text" name="name" id="user-name" value="{{ data_get($user, 'name') }}">
                @error('name')
                <p class="error-text">※{{ $message }}</p>
                @enderror
              </div>
              <div class="c-form-item">
                <label for="user_identifier" class="c-form-item-title">ユーザーID</label>
                <input type="text" name="user_identifier" id="user-id" value="{{ data_get($user, 'user_identifier', '') }}">
                @error('user_identifier')
                <p class="error-text">※{{ $message }}</p>
                @enderror
                @if(session('flash_failed'))
                <p class="error-text">※{{ session('flash_failed') }}</p>
                @endif
              </div>
              <div class="c-form-item">
                <label for="user_cover_image" class="c-form-item-title">プロフィールカバー画像</label>
                <div class="c-form__cover-preview">
                  @if(!empty(data_get($user, 'user_cover_image'))s)
                  <img src="{{ asset('storage/'. data_get($user, 'user_cover_image')) }}" alt="">
                  @else
                  <img src="/img/common/dummy.png" alt="">
                  @endif
                </div>
                <input type="file" name="user_cover_image" id="user-cover-image" accept="image/png, image/jpeg, image/jpg">
                @error('user_cover_image')
                <p class="error-text">※{{ $message }}</p>
                @enderror
              </div>
              <div class="c-form-item">
                <label for="sns_x" class="c-form-item-title">X（Twitter）アカウント</label>
                <input type="text" name="sns_x" id="user-x" value="{{ data_get($user, 'sns_x', '') }}" placeholder="https://twitter.com/username">
                @error('sns_x')
                <p class="error-text">※{{ $message }}</p>
                @enderror
              </div>
              <div class="c-form-item">
                <label for="sns_facebook" class="c-form-item-title">Facebookアカウント</label>
                <input type="text" name="sns_facebook" id="user-fb" value="{{ data_get($user, 'sns_facebook', '') }}" placeholder="https://www.facebook.com/username/">
                @error('sns_facebook')
                <p class="error-text">※{{ $message }}</p>
                @enderror
              </div>
              <div class="c-form-item">
                <label for="sns_insta" class="c-form-item-title">Instagramアカウント</label>
                <input type="text" name="sns_instagram" id="user-insta" value="{{ data_get($user, 'sns_instagram', '') }}" placeholder="https://www.instagram.com/username/">
                @error('sns_instagram')
                <p class="error-text">※{{ $message }}</p>
                @enderror
              </div>
              <div class="c-form-item">
                <label for="introduction_text" class="c-form-item-title">自己紹介文</label>
                <textarea name="introduction_text" id="user-intro" cols="30" rows="10">{{ data_get($user, 'introduction_text', '') }}</textarea>
                @error('introduction_text')
                <p class="error-text">※{{ $message }}</p>
                @enderror
              </div>
              <div class="c-form-submit c-button-wrap">
                <button type="submit" class="c-button">更新する</button>
                <input type="hidden" name="user_id" value="{{ data_get($user, 'id') }}">
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
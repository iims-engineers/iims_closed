<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <title>パスワードの設定</title>
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
          <h1 class="p-sub__head01">パスワードの設定</h1>
          <div class="p-sub__lead">
            <p>
              {{ $user->name }}さん、MOT2へようこそ！
              まず、MOT2へログインするためのパスワードを設定してください。
            </p>
          </div>
          @if($errors->any())
          <div class="form-error">
            <ul>
              @foreach ($errors->all() as $error)
              <li class="error-text">・{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif
          @if(session('flash_message'))
          <div class="form-error">
            <p class="error-text">{{ session('flash_message') }}</p>
          </div>
          @endif
          <form action="{{ route('password.new.store') }}" method="POST" class="c-form">
            @csrf
            <div class="c-form-item">
              <label for="password" class="c-form-item-title">パスワード</label>
              <input type="password" name="password" id="password" required>
              @error('password')
              <p class="error-text">※{{ $message }}</p>
              @enderror
            </div>
            <div class="c-form-item">
              <label for="password-check" class="c-form-item-title">パスワードを再度入力してください</label>
              <input type="password" name="password_confirmation" id="password-check" required>
              @error('password_confirmation')
              <p class="error-text">※{{ $message }}</p>
              @enderror
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
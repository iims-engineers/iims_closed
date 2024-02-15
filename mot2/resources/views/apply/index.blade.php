<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <title>ユーザー登録の申請</title>
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
          <h1 class="p-sub__head01">ユーザー登録の申請</h1>
          <div class="p-sub__lead">
            <p>
              MOT2のユーザーの登録は承認制となっています。<br>
              以下のフォームより申請を行ってください。
            </p>
            <p>
              お送りいただいた後、自動返信メールをお送りいたします。<br>
              メールが届かない場合は、ご記入いただいたメールアドレスに誤りがあった可能性がございます。お手数ですが再度ユーザー登録の申請をし直してください。
            </p>
            <p>
              運営が申請内容を確認でき次第、メールにてお知らせいたしますので、しばらくお待ちください。
            </p>
          </div>
          <form action="{{ route('apply') }}" method="POST" class="c-form">
            @csrf
            <div class="c-form-item c-form-item--register">
              <label for="name" class="c-form-item-title">お名前<span class="c-form-require">必須</span></label>
              <input type="text" name="name" id="name" class="@error('name') is-invalid @enderror" value="{{ old('name') }}">
              @error('name')
              <p class="error">※{{ $message }}</p>
              @enderror
            </div>
            <div class="c-form-item c-form-item--register">
              <label for="email" class="c-form-item-title">メールアドレス<span class="c-form-require">必須</span></label>
              <input type="email" name="email" id="email" class="@error('email') is-invalid @enderror" value="{{ old('email') }}">
              <span class="c-form-note">※ユーザー登録後、このメールアドレスをログイン時に使用します。</span>
              @error('email')
              <p class="error">※{{ $message }}</p>
              @enderror
            </div>
            <div class="c-form-item c-form-item--register">
              <label for="past-join" class="c-form-item-title">過去のIIMS活動参加歴</label>
              <textarea name="past-join" class="@error('past-join') is-invalid @enderror" id="past-join" cols="30" rows="3" value="{{ old('past-join') }}"></textarea>
              @error('past-join')
              <p class="error">※{{ $message }}</p>
              @enderror
            </div>
            <div class="c-form-submit c-button-wrap">
              <button type="submit" class="c-button">確認画面へ</button>
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
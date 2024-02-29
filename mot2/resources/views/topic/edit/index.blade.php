<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <title>トピックの編集</title>
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
          <h1 class="p-sub__head01">トピックの編集</h1>
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
          <div class="p-sub__inner">
            <div class="c-user">
              <div class="c-user-icon">
                <img src="/img/common/dummy_icon.png" alt="">
              </div>
              <div class="c-user-name">{{ $user->name }}</div>
            </div>
            <form action="{{ route('topic.store') }}" method="POST" class="c-form">
              @csrf
              <input type="hidden" name="id" value="{{ $topic->id }}">
              <div class="c-form-item">
                <label for="topic-title" class="c-form-item-title">トピックのタイトル</label>
                <input type="text" name="topic-title" id="topic-title" value="{{ $topic->title }}">
                @error('topic-title')
                <p class="error-text">※{{ $message }}</p>
                @enderror
              </div>
              <div class="c-form-item">
                <label for="topic-detail" class="c-form-item-title">トピックの本文</label>
                <textarea name="topic-detail" id="topic-detail" cols="30" rows="10" value="{{ old('topic-detail') }}">{{ $topic->content }}</textarea>
                @error('topic-detail')
                <p class="error-text">※{{ $message }}</p>
                @enderror
              </div>
              <div class="c-form-submit c-button-wrap">
                <button type="submit" class="c-button">編集完了</button>
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
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
            @if($users->isEmpty())
            <div class="c-user">
              <p>現在表示できるユーザーは存在しません。</p>
            </div>
            @else
            @foreach($users as $user)
            <div class="c-user">
              <div class="c-user-icon">
                <img src="{{ ('/img/common/dummy_icon.png') }}" alt="">
              </div>
              <div class="c-user-info">
                <div class="c-user-name">{{ $user->name }}</div>
                <div></div>
              </div>
            </div>
            @endforeach
            @endif
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
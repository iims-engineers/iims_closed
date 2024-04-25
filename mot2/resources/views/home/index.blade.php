<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <title>HOME</title>
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
          <h1 class="p-sub__head01">HOME</h1>
          <div class="p-sub__btns">
            <a href="{{ route('topic.show.create') }}" class="c-button--large">
              <img src="{{ ('/img/common/icon-topic.svg') }}" alt="">
              <span>トピックを新規作成する</span>
            </a>
            <!-- <a href="/archives/" class="c-button--large">
              <img src="{{ ('/img/common/icon-archive.svg') }}" alt="">
              <span>多文化交流アーカイブ</span>
            </a> -->
          </div>
        </section>
        <section class="p-sub__section">
          <h2 class="p-sub__head02">今盛り上がっているおすすめトピック</h2>
          <div class="c-topic-wrap">
            <a href="/topic/show/topicID/" class="c-topic-title">高崎に集まれる人募集！</a>
            <div class="p-sub__inner">
              <div class="c-user">
                <a href="/user/show/user-id/">
                  <div class="c-user-icon">
                    <img src="{{ ('/img/common/dummy_icon.png') }}" alt="">
                  </div>
                  <div class="c-user-info">
                    <div class="c-user-name">もっと太郎</div>
                    <div class="c-user-id">@username</div>
                  </div>
                </a>
              </div>
              <div class="c-topic-detail">
                <p>
                  高崎来たら、まさかのまつんぼと遭遇！笑<br>
                  めっちゃ急なんですけど誰か集まれる人いませんか〜？一緒に飲みに行きましょ！
                </p>
                <time class="c-topic-date" datetime="2024-11-11T15:00:33">2024/11/11 15:00:33</time>
              </div>
              <div class="c-button-wrap">
                <a href="" class="c-button">
                  <img src="{{ ('/img/common/icon-reply.svg') }}" alt="">
                  <span>このトピックにコメントする</span>
                </a>
                <a href="" class="c-button">
                  <img src="{{ ('/img/common/icon-pencil.svg') }}" alt="">
                  <span>このトピックを編集する</span>
                </a>
              </div>
              <div class="c-reply-wrap">
                <div class="c-reply">
                  <div class="c-user-icon">
                    <img src="{{ ('/img/common/dummy_icon.png') }}" alt="">
                  </div>
                  <div class="c-reply-detail">
                    <p>
                      まじで俺もビックリだわ〜笑<br>
                      username終電までいる予定だって！
                    </p>
                  </div>
                </div>
                <div class="c-reply">
                  <div class="c-user-icon">
                    <img src="{{ ('/img/common/dummy_icon.png') }}" alt="">
                  </div>
                  <div class="c-reply-detail">
                    <p>
                      まじで俺もビックリだわ〜笑<br>
                      username終電までいる予定だって！
                    </p>
                  </div>
                </div>
              </div>
              <div class="c-button-wrap">
                <a href="" class="c-button">
                  <img src="{{ ('/img/common/icon-show-topic.svg') }}" alt="">
                  <span>このトピックを見る</span>
                </a>
              </div>
            </div>
          </div>
        </section>
        {{-- 最新のトピックを5件表示 --}}
        <section class="p-sub__section">
          <h2 class="p-sub__head02">トピック一覧</h2>
          @forelse($topics as $topic)
          <div class="c-topic-wrap">
            <a href="/topic/show/topicID/" class="c-topic-title js-accordion-topic">{{ $topic->title }}</a>
            <div class="p-sub__inner">
              <div class="c-user">
                <a href="{{ route('user.show.detail', ['id' => $topic->user_id]) }}">
                  <div class="c-user-icon">
                    <img src="{{ ('/img/common/dummy_icon.png') }}" alt="">
                  </div>
                  <div class="c-user-info">
                    <div class="c-user-name">{{ $topic->name }}</div>
                  </div>
                </a>
              </div>
              <div class="c-topic-detail">
                <p>{!! nl2br(htmlspecialchars($topic->content)) !!}</p>
                <time class="c-topic-date" datetime="{{ $topic->created_at }}">{{ $topic->created_at }}</time>
              </div>
              <div class="c-button-wrap">
                <a href="" class="c-button">
                  <img src="{{ ('/img/common/icon-reply.svg') }}" alt="">
                  <span>このトピックに回答する</span>
                </a>
                <a href="{{ route('topic.show.detail', ['id' => $topic->id]) }}" class="c-button">
                  <img src="{{ ('/img/common/icon-show-topic.svg') }}" alt="">
                  <span>このトピックを見る</span>
                </a>
                @if(Auth::user()->id === $topic->user_id)
                <a href="{{ route('topic.show.edit', ['id' => $topic->id]) }}" class="c-button">
                  <img src="{{ ('/img/common/icon-pencil.svg') }}" alt="">
                  <span>このトピックを編集する</span>
                </a>
                @endif
              </div>
            </div>
          </div>
          @empty
          <p>現在表示できるトピックはありません。</p>
          @endforelse
        </section>
        <section class="p-sub__section">
          <h2 class="p-sub__head02">運営へのメッセージはこちらから</h2>
          <div class="p-sub__inner">
            <div class="p-sub__lead">
              <p>
                MOT2を使っていただいてお気付きの点、改善してほしい点などございましたら以下より送信ください。<br>
                MOT2は無償のプロジェクトです。あなたからのご感想や応援のメッセージがとても励みになります！<br>
              </p>
              @if($errors->any())
              <div class="form-error">
                <ul>
                  @foreach ($errors->all() as $error)
                  <li class="error-text">・{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
              @endif
            </div>
            <form action="" method="POST" class="c-form">
              @csrf
              <div class="c-form-item">
                <textarea name="message" id="message" required cols="30" rows="10"></textarea>
              </div>
              <div class="c-form-submit c-button-wrap">
                <button type="submit" class="c-button">送信する</button>
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
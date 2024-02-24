<!--include START-->
<header class="l-header">
  <div class="l-header__logo">
    <a href="{{ route('home.index') }}">
      <img src="{{ asset('/img/common/mot2_simple_logo.svg') }}" alt="">
    </a>
  </div>
  <div class="l-header__btn">
    <div class="l-header__btn-item">
      <button type="button" class="l-header__info-btn">
        <img src="{{ asset('/img/common/icon-bell.svg') }}" alt="">
        <span>お知らせ</span>
        <span class="attention-num">1</span>
      </button>
      <div class="l-header__info">
        <div class="l-header__info-list">
          <div class="l-header__info-list-item unread">
            リンクなしお知らせリンクなしお知らせリンクなしお知らせ
          </div>
          <div class="l-header__info-list-item unread">
            <a href="">リンクありお知らせリンクありお知らせリンクありお知らせリンクありお知らせ</a>
          </div>
          <div class="l-header__info-list-item">
            <a href="">リンクありお知らせ</a>
          </div>
          <div class="l-header__info-list-item">
            リンクなしお知らせ
          </div>
        </div>
      </div>
    </div>
    <form action="{{ route('logout') }}" method="POST" name="a_form_logout">
      @csrf
      <div class="l-header__btn-item">
        <a href="#" onclick="document.a_form_logout.submit();">
          <img src="{{ asset('/img/common/icon-exit.svg') }}" alt="">
          <span>ログアウト</span>
        </a>
      </div>
    </form>
  </div>
</header>
<!--include END-->
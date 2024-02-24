<!--include START-->
<footer class="l-footer">
  <!-- <div class="l-pagetop"><button type="button" class="pagetop-btn"><span>PAGE TOP</span></button></div> -->
  <!-- <div class="copyright-wrap">Copyright &copy; ○○○○○○○○○○○○. All rights reserved.</div> -->
  <div class="l-footer__btn">
    <div class="l-footer__btn-item">
      <a href="/home/">
        <img src="{{ asset('/img/common/icon-earth.svg') }}" width="32" height="32" alt="">
        <span>HOME</span>
      </a>
    </div>
    <div class="l-footer__btn-item">
      <a href="">
        <img src="{{ asset('/img/common/icon-search.svg') }}" width="32" height="32" alt="">
        <span>検索</span>
      </a>
    </div>
    <div class="l-footer__btn-item">
      <a href="{{ route('user.index') }}">
        <img src="{{ asset('/img/common/icon-users.svg') }}" width="32" height="32" alt="">
        <span>メンバー</span>
      </a>
    </div>
    <div class="l-footer__btn-item">
      <a href="/user/edit/user-id/">
        <img src="{{ asset('/img/common/dummy_icon.png') }}" alt="">
        <!-- <img src="/img/common/icon-accessibility.svg" alt=""> -->
        <span>個人設定</span>
      </a>
    </div>
  </div>
</footer>
<!--include END-->
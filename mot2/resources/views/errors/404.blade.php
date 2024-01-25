<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <title>title</title>
  <meta name="robots" content="index, follow">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width,initial-scale=1">

  <meta property="og:site_name" content="">
  <meta property="og:title" content="">
  <meta property="og:type" content="">
  <meta property="og:image" content="">
  <meta property="og:url" content="">
  <meta property="og:description" content="">
  <meta property="og:locale" content="ja_JP">

  <meta property="fb:app_id" content="288016516859845">
  <meta name="twitter:card" content="summary_large_image">

  <link rel="shortcut icon" href="/favicon.ico">
  <link rel="apple-touch-icon" type="image/png" href="/apple-touch-icon-180x180.png">
  <link rel="icon" type="image/png" href="/icon-192x192.png">
  <meta name="theme-color" content="#ffffff">
  <link rel="manifest" href="/manifest.json">
  <link rel="search" type="application/opensearchdescription+xml" href="/opensearch.xml" title="">

  <link rel="stylesheet" href="{{ asset('/css/style.css') }}" media="all">
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css" media="all">

  <!-- CSSを非同期ロードさせたい時に使ってください。
<link rel="preload" href="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css"></noscript>
<script>
/*! loadCSS. [c]2017 Filament Group, Inc. MIT License */
!function(t){"use strict";t.loadCSS||(t.loadCSS=function(){});var e=loadCSS.relpreload={};if(e.support=function(){var e;try{e=t.document.createElement("link").relList.supports("preload")}catch(a){e=!1}return function(){return e}}(),e.bindMediaToggle=function(t){function e(){t.addEventListener?t.removeEventListener("load",e):t.attachEvent&&t.detachEvent("onload",e),t.setAttribute("onload",null),t.media=a}var a=t.media||"all";t.addEventListener?t.addEventListener("load",e):t.attachEvent&&t.attachEvent("onload",e),setTimeout(function(){t.rel="stylesheet",t.media="only x"}),setTimeout(e,3e3)},e.poly=function(){if(!e.support())for(var a=t.document.getElementsByTagName("link"),n=0;n<a.length;n++){var o=a[n];"preload"!==o.rel||"style"!==o.getAttribute("as")||o.getAttribute("data-loadcss")||(o.setAttribute("data-loadcss",!0),e.bindMediaToggle(o))}},!e.support()){e.poly();var a=t.setInterval(e.poly,500);t.addEventListener?t.addEventListener("load",function(){e.poly(),t.clearInterval(a)}):t.attachEvent&&t.attachEvent("onload",function(){e.poly(),t.clearInterval(a)})}"undefined"!=typeof exports?exports.loadCSS=loadCSS:t.loadCSS=loadCSS}("undefined"!=typeof global?global:this);
</script>
-->
</head>

<body class="page">
  <!-- <div class="transitionBg is-show"></div> -->
  <div class="l-container">

    <!-- l-header START -->
    <!--include START-->
    <header class="l-header">
      <div class="l-header__logo">
        <a href="/home/">
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
        <div class="l-header__btn-item">
          <a href="/about/">
            <img src="{{ asset('/img/common/icon-exit.svg') }}" alt="">
            <span>ログアウト</span>
          </a>
        </div>
      </div>
    </header>
    <!--include END-->

    <!-- l-header END -->

    <div class="l-contents">
      <main class="l-main">
        <section class="sub">
          <div class="topic-path">
            <div class="path top"><a href="/">トップページ</a></div>
            <div class="path current"><span>お探しのページが見つかりません</span></div>
          </div>
          <div class="subpage-head-wrap">
            <h2 class="subpage-title">お探しのページが見つかりません</h2>
          </div>
          <div class="subpage-wrap">
            <div class="notfound-wrap">
              <p class="text">大変申し訳ございませんが、お探しのページは削除されたか、名前が変更されている等、現在ご利用できない可能性がございます。</p>
              <div class="viewmore-btn"><a href="/">トップページへ戻る</a></div>
            </div>
          </div>
        </section>
      </main>
      <!-- l-footer START -->
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
            <a href="/user/">
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

      <!-- l-footer END -->
    </div>
  </div>
  <!-- *** JavaScript *** -->
  <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
  <script src="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js" type="text/javascript"></script>
  <script src="{{ asset('/js/script.js') }}"></script>

  <noscript>
    <p class="no-js-text">当サイトをご覧になる際は、JavaScriptを有効にしてください。</p>
  </noscript>
</body>

</html>
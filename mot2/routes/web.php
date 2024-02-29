<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AboutController;
use \App\Http\Controllers\ApplyController;
use \App\Http\Controllers\LoginController;
use \App\Http\Controllers\PasswordController;
use \App\Http\Controllers\TopicController;
use \App\Http\Controllers\HomeController;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\Admin\user\ApproveController;

// Route::get('/1', function () {
//     return view('topic/show/index');
// });

/* ------------------------------------------------------------------------------------------------ */
/* 未ログイン時もアクセス可能 */

// TOP(MOT2紹介ページ)の表示
Route::get('/', [AboutController::class, 'index'])->name('top');

/* ユーザー登録申請 */
Route::prefix('/apply')
    ->name('apply.')
    ->group(function () {
        // 新規登録申請画面の表示
        Route::get('', [ApplyController::class, 'showForm'])->name('form');
        // 入力データのバリデーション
        Route::post('/register', [ApplyController::class, 'applyCheck'])->name('check');
        // 確認画面の表示
        Route::get('/confirm', [ApplyController::class, 'applyConfirm'])->name('confirm');
        // 登録処理
        Route::post('/store', [ApplyController::class, 'applyStore'])->name('store');
        // 登録申請完了画面の表示
        Route::get('/complete', [ApplyController::class, 'showComplete'])->name('complete');
    });

/* パスワード関連 */
Route::prefix('/password')
    ->name('password.')
    ->group(function () {

        /* 新規登録関連 */
        // パスワード新規登録 - 入力画面の表示
        Route::get('/new/{token}', [PasswordController::class, 'showFormNew'])->name('new.form');
        // パスワード新規登録 - 登録実行
        Route::post('/new/store', [PasswordController::class, 'storeNew'])->name('new.store');
        // パスワード新規登録 - 完了画面の表示 ※なぜか「to_route('password.new.complete');」が動作しないので、一旦viewファイルを直接返却させる
        // Route::get('/new/complete', [PasswordController::class, 'completeNew'])->name('ew.complete');

        /* リセット関連 */
        // パスワードリセット(非ログイン時) - 入力画面の表示
        Route::get('/reset/mail-check', [PasswordController::class, 'resetShowMailForm'])->name('reset.form-mail');
        // パスワードリセット(非ログイン時) - メール送信実行
        Route::post('/reset/mail-check', [PasswordController::class, 'resetSendMail'])->name('reset.check');
        // パスワードリセット(非ログイン時) - メール送信完了画面の表示
        Route::get('/reset/mail-check/send', [PasswordController::class, 'resetShowSendMail'])->name('reset.send');
        // パスワードリセット(非ログイン時) - パスワード入力画面の表示
        Route::get('/reset/form', [PasswordController::class, 'resetShowPasswordForm'])->name('reset.form-password');
        // パスワードリセット(非ログイン時) - パスワード変更実行
        Route::post('/reset/store', [PasswordController::class, 'resetStorePassword'])->name('reset.store');
        // パスワードリセット(非ログイン時) - パスワード変更完了画面の表示
        Route::get('/reset/complete', [PasswordController::class, 'resetShowComplete'])->name('reset.complete');
    });


/* ログイン */
// ログインフォームの表示
Route::get('/login', [LoginController::class, 'showForm'])->name('login.form')->middleware('guest');
// ログイン処理
Route::post('/login', [LoginController::class, 'login'])->name('login')->middleware('guest');

/* ------------------------------------------------------------------------------------------------ */

/* ------------------------------------------------------------------------------------------------ */
/* ログイン時のみアクセス可能 */
Route::middleware('auth')
    ->group(function () {

        // ホーム画面の表示
        Route::get('/home', [HomeController::class, 'index'])->name('home.index');

        // ログアウト処理
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

        /* ユーザー情報 */
        // 一覧画面の表示
        Route::get('/user/list', [UserController::class, 'showList'])->name('user.list');
        // 詳細画面の表示
        Route::get('/user/detail/{id}', [UserController::class, 'detail'])->name('user.detail');

        /* トピック関連 */
        // トピック - 一覧画面の表示
        Route::get('/topic/list', [TopicController::class, 'showList'])->name('topic.show.list');
        // トピック - 詳細画面の表示
        Route::get('/topic/{id}', [TopicController::class, 'showDetail'])->name('topic.show.detail');
        // トピック新規作成 - 入力画面の表示
        Route::get('/topic/new', [TopicController::class, 'showCreate'])->name('topic.show.create');
        // トピック編集 - 編集画面の表示
        Route::get('/topic/edit/{id}', [TopicController::class, 'showEdit'])->name('topic.show.edit');
        // トピック - 保存実行
        Route::post('/topic/store', [TopicController::class, 'store'])->name('topic.store');
    });


/* ------------------------------------------------------------------------------------------------ */


/* 
 * 管理者側
 */
Route::prefix('/admin')
    ->name('admin.')
    ->group(function () {
        // 承認待ちユーザー 一覧画面の表示
        Route::get('/user/unapproved', [ApproveController::class, 'showList'])->name('show.list');
        // 承認待ちユーザー 詳細画面の表示
        Route::get('/user/unapproved/{id}', [ApproveController::class, 'showDetail'])->name('show.detail');
        // 承認処理
        Route::post('/user/approve', [ApproveController::class, 'approve'])->name('unapprovedUser.approve');
    });

/* 404エラー */
Route::get('/error', function () {
    return view('errors/404');
})->name('404');

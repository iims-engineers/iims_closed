<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AboutController;
use \App\Http\Controllers\ApplyController;
use \App\Http\Controllers\LoginController;
use \App\Http\Controllers\PasswordController;
use \App\Http\Controllers\HomeController;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\Admin\user\ApproveController;

Route::get('/1', function () {
    return view('password/mail-check/index');
});

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
// パスワード新規登録 - 入力画面の表示
Route::get('/password/new/{token}', [PasswordController::class, 'showFormNew'])->name('password.new.form');
// パスワード新規登録 - 登録実行
Route::post('/password/new/store', [PasswordController::class, 'storeNew'])->name('password.new.store');
// パスワード新規登録 - 完了画面の表示 ※なぜか「to_route('password.new.complete');」が動作しないので、一旦viewファイルを直接返却させる
// Route::get('/password/new/complete', [PasswordController::class, 'completeNew'])->name('password.new.complete');
// パスワードリセット(非ログイン時) - 入力画面の表示
Route::get('/password/reset/mail-check', [PasswordController::class, 'resetShowMailForm'])->name('password.reset.form-mail');
// パスワードリセット(非ログイン時) - メール送信実行
Route::post('/password/reset/mail-check', [PasswordController::class, 'resetSendMail'])->name('password.reset.check');
// パスワードリセット(非ログイン時) - メール送信完了画面の表示
Route::get('/password/reset/mail-check/send', [PasswordController::class, 'resetShowSendMail'])->name('password.reset.send');
// パスワードリセット(非ログイン時) - パスワード入力画面の表示
Route::get('/password/reset/form', [PasswordController::class, 'resetShowPasswordForm'])->name('password.reset.form-password');
// パスワードリセット(非ログイン時) - パスワード変更実行
Route::post('/password/reset/store', [PasswordController::class, 'resetStorePassword'])->name('password.reset.store');
// パスワードリセット(非ログイン時) - パスワード変更完了画面の表示
Route::get('/password/reset/complete', [PasswordController::class, 'resetShowComplete'])->name('password.reset.complete');


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
        Route::get('/user', [UserController::class, 'index'])->name('user.index');
        // 詳細画面の表示
        Route::get('/user/{id}', [UserController::class, 'detail'])->name('user.detail');
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

        /* 404エラー */
        Route::get('/error', function () {
            return view('errors/404');
        })->name('404');
    });

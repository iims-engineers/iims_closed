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
/* ログイン状態に関わらずアクセス可能 */

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
        Route::prefix('/new')
            ->name('new.')
            ->group(function () {
                // パスワード新規登録 - 入力画面の表示
                Route::get('/{token}', [PasswordController::class, 'showFormNew'])->name('form');
                // パスワード新規登録 - 登録実行
                Route::post('/store', [PasswordController::class, 'storeNew'])->name('store');
                // パスワード新規登録 - 完了画面の表示 ※なぜか「to_route('password.new.complete');」が動作しないので、一旦viewファイルを直接返却させる
                // Route::get('/complete', [PasswordController::class, 'completeNew'])->name('complete');
            });

        /* リセット関連 */
        Route::prefix('/reset')
            ->name('reset.')
            ->group(function () {
                // パスワードリセット(非ログイン時) - 入力画面の表示
                Route::get('/mail-check', [PasswordController::class, 'resetShowMailForm'])->name('form-mail');
                // パスワードリセット(非ログイン時) - メール送信実行
                Route::post('/mail-check', [PasswordController::class, 'resetSendMail'])->name('check');
                // パスワードリセット(非ログイン時) - メール送信完了画面の表示
                Route::get('/mail-check/send', [PasswordController::class, 'resetShowSendMail'])->name('send');
                // パスワードリセット(非ログイン時) - パスワード入力画面の表示
                Route::get('/form', [PasswordController::class, 'resetShowPasswordForm'])->name('form-password');
                // パスワードリセット(非ログイン時) - パスワード変更実行
                Route::post('/store', [PasswordController::class, 'resetStorePassword'])->name('store');
                // パスワードリセット(非ログイン時) - パスワード変更完了画面の表示
                Route::get('/complete', [PasswordController::class, 'resetShowComplete'])->name('complete');
            });
    });
/* ------------------------------------------------------------------------------------------------ */


/* ------------------------------------------------------------------------------------------------ */
/**
 * 未ログイン時のみアクセス可能
 */
Route::middleware('guest')
    ->group(
        function () {

            /* ログイン */
            // ログインフォームの表示
            Route::get('/login', [LoginController::class, 'showForm'])->name('login.form');
            // ログイン処理
            Route::post('/login', [LoginController::class, 'login'])->name('login');
        }
    );
/* ------------------------------------------------------------------------------------------------ */

/* ------------------------------------------------------------------------------------------------ */
/**
 * ログイン時のみアクセス可能
 */
Route::middleware('auth')
    ->group(function () {

        // ホーム画面の表示
        Route::get('/home', [HomeController::class, 'index'])->name('home.index');

        // ログアウト処理
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

        /* ユーザー情報 */
        Route::prefix('/user')
            ->name('user.')
            ->group(function () {
                // 一覧画面の表示
                Route::get('/list', [UserController::class, 'showList'])->name('list');
                // 詳細画面の表示
                Route::get('/detail/{id}', [UserController::class, 'detail'])->name('detail');
            });

        /* トピック関連 */
        Route::prefix('/topic')
            ->name('topic.')
            ->group(function () {
                // トピック - 一覧画面の表示
                Route::get('/list', [TopicController::class, 'showList'])->name('show.list');
                // トピック新規作成 - 入力画面の表示
                Route::get('/new', [TopicController::class, 'showCreate'])->name('show.create');
                // トピック - 詳細画面の表示
                Route::get('/detail/{id}', [TopicController::class, 'showDetail'])->name('show.detail');
                // トピック編集 - 編集画面の表示
                Route::get('/edit/{id}', [TopicController::class, 'showEdit'])->name('show.edit');
                // トピック - 保存実行
                Route::post('/store', [TopicController::class, 'store'])->name('store');
            });
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

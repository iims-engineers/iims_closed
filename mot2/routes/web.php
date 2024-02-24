<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AboutController;
use \App\Http\Controllers\ApplyController;
use \App\Http\Controllers\LoginController;
use \App\Http\Controllers\PasswordController;
use \App\Http\Controllers\HomeController;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\Admin\user\ApproveController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
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
// パスワード新規登録画面の表示
Route::get('/password/new/{token}', [PasswordController::class, 'showFormNew'])->name('password.new.form');
// パスワード新規登録処理
Route::post('/password/new/store', [PasswordController::class, 'storeNew'])->name('password.new.store');
// パスワード新規登録完了画面の表示 ※なぜか「to_route('password.new.complete');」が動作しないので、一旦viewファイルを直接返却させる
// Route::get('/password/new/complete', [PasswordController::class, 'completeNew'])->name('password.new.complete');

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
    });

/* ------------------------------------------------------------------------------------------------ */


/* 
 * 管理者側
 */
// 承認待ちユーザー 一覧画面の表示
Route::get('/admin/user/unapproved', [ApproveController::class, 'showList'])->name('admin.show.list');
// 承認待ちユーザー 詳細画面の表示
Route::get('/admin/user/unapproved/{id}', [ApproveController::class, 'showDetail'])->name('admin.show.detail');
// 承認処理
Route::post('/admin/user/approve', [ApproveController::class, 'approve'])->name('admin.unapprovedUser.approve');

/* 404エラー */
Route::get('/error', function () {
    return view('errors/404');
})->name('404');

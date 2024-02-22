<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AboutController;
use \App\Http\Controllers\ApplyController;
use \App\Http\Controllers\LoginController;
use \App\Http\Controllers\PasswordController;
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

Route::get('/home', function () {
    return view('home/index');
})->name('home');

// TOP
Route::get('/', [AboutController::class, 'index'])->name('top');

/* ユーザー登録申請 */
// 新規登録申請画面の表示
Route::get('/apply', [ApplyController::class, 'index'])->name('apply.index');
// 入力データのバリデーション
Route::post('/apply/register', [ApplyController::class, 'apply'])->name('apply');
// 確認画面の表示
Route::get('/apply/confirm', [ApplyController::class, 'applyConfirm'])->name('apply.confirm');
// 登録処理
Route::post('/apply/store', [ApplyController::class, 'applyStore'])->name('apply.store');
// 登録申請完了画面の表示
Route::get('/apply/complete', [ApplyController::class, 'showComplete'])->name('apply.complete');

/* パスワード関連 */
// パスワード新規登録画面の表示
Route::get('/password/new/{token}', [PasswordController::class, 'indexNew'])->name('password.index.new');
// パスワード新規登録処理
Route::post('/password/new/store', [PasswordController::class, 'store'])->name('password.store');

/* ログイン */
// ログインフォームの表示
// Route::get('/login', [PasswordController::class, 'index'])->name('password.new');

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

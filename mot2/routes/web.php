<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('welcome');
});

/* ユーザー登録関連 */
// 新規登録申請画面の表示
Route::get('/apply', [UserController::class, 'showApply']);
// 入力データのバリデーション
Route::post('/apply/register', [UserController::class, 'apply'])->name('apply');
// 確認画面の表示
Route::get('/apply/confirm', [UserController::class, 'applyConfirm'])->name('apply.confirm');
// 登録処理
Route::post('/apply/store', [UserController::class, 'store'])->name('apply.store');
// 登録完了後ホーム画面に遷移
Route::get('/home', function () {
    return view('home/index');
})->name('home');


/* 404エラー */
Route::get('/error', function () {
    return view('errors/404');
})->name('404');

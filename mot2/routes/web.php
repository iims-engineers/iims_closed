<?php

use App\Http\Controllers\TopicController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

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

// トピック
Route::controller(TopicController::class)->group(function () {
    Route::get('/topic', 'index'); // 一覧
    // Route::get('/topic', 'index'); // 新規作成
    // Route::get('/topic', 'index'); // 編集
    // Route::get('/topic', 'index'); // 削除
});

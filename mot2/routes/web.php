<?php

use App\Http\Controllers\UserController;
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

// デフォルト TOP画面
Route::get('/', function () {
    return view('welcome');
});


// テストファイル
Route::get('/index', fn () => view('index'));

// Userコントローラー
Route::get('/user', [UserController::class, 'show']);

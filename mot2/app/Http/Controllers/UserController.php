<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    /*
     * ユーザー新規登録画面の表示
     */
    public function showApply()
    {
        return view('apply/index');
    }

    /*
     * ユーザー新規登録処理
     */
    public function apply(UserRequest $request)
    {
        // 入力データのバリデート
        $validated = $request->validated();

        // バリデートにエラーがエラーが無い場合のみ確認画面に遷移
        return to_route('apply.confirm');
    }

    /*
     * ユーザー新規登録 確認画面
     */
    public function applyConfirm()
    {
        return view('apply/confirm/index');
    }
}

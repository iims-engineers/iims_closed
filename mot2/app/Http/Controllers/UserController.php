<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

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
    public function apply(Request $request)
    {
        // 入力データのバリデート
        $data = $request->validate([
            'name' => ['required', 'string', 'max:50'],  // 氏名:50文字以内
            'email' => ['required', 'email', 'max:255'], // メールアドレス:255文字以内
            'past-join' => ['string', 'max:255'],        // 過去の活動参加歴:255文字以内
        ]);

        // バリデートにエラーがエラーが無い場合のみ確認画面に遷移
        return to_route('apply.confirm');
    }

    /*
     * ユーザー新規登録 確認画面
     */
    public function applyConfirm(Request $request)
    {
        return view('apply/confirm/index');
    }
}

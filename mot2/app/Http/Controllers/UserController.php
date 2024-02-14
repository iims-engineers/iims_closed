<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    // ユーザー新規登録申請時のデータ
    private $formApply = [
        'name',       // 氏名
        'email',      // メールアドレス
        'past-join',  // 活動参加歴
    ];

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
        $input = $request->only($this->formApply);
        // 入力データをセッションに保存
        session($input);

        // バリデートにエラーがエラーが無い場合のみ確認画面に遷移
        return to_route('apply.confirm');
    }

    /*
     * ユーザー新規登録 確認画面
     */
    public function applyConfirm()
    {
        // セッションから入力データを取得
        $form_input = session()->all();
        if (!isset($form_input['name']) || !isset($form_input['email'])) {
            // 404 or 入力画面に戻す？
        }

        return view('apply/confirm/index', [
            'form_input' => $form_input,
        ]);
    }
}

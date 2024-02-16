<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Arr;
use App\Models\User;

class UserController extends Controller
{
    // ユーザー新規登録申請時のデータ
    private $formApply = [
        'name',       // 氏名
        'email',      // メールアドレス
        'past-join',  // 活動参加歴
    ];

    /*
     * ユーザー新規登録処理
     */
    public function store(Request $request)
    {
        // 確認画面から渡った入力データをセッションから取得
        $form_input = $request->session()->get('form_input');
        if (empty($form_input)) {
            /* 入力データがセッションに存在しない場合は404 */
            return to_route('404');
        }

        // Userモデルのインスタンスを生成
        $user = new User();
        // 入力データをUserモデルのインスタンスにセット
        $user->name = Arr::get($form_input, 'name');
        $user->email = Arr::get($form_input, 'email');
        $user->past_join = Arr::get($form_input, 'past-join');

        // 登録実行
        try {
            // データベースに保存
            $user->save();
            // ホーム画面に遷移
            return to_route('apply.complete');
        } catch (\Exception $e) {
            // 登録失敗したら404を表示
            return to_route('404');
        }
    }

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

        // 活動参加歴が未入力の場合は空文字をセット
        if (!isset($input['past-join'])) {
            $input['past-join'] = '';
        }
        // 入力データをセッションに保存
        $request->session()->put(['form_input' => [
            'name' => Arr::get($input, 'name'),
            'email' => Arr::get($input, 'email'),
            'past-join' => Arr::get($input, 'past-join'),
        ]]);

        // バリデートにエラーがエラーが無い場合のみ確認画面に遷移
        return to_route('apply.confirm');
    }

    /*
     * ユーザー新規登録 確認画面
     */
    public function applyConfirm(Request $request)
    {
        // セッションから入力データを取得
        $form_input = $request->session()->get('form_input');
        if (empty($form_input)) {
            // セッションに値がなければ入力画面に戻す
            return to_route('apply');
        }

        return view('apply/confirm/index', [
            'form_input' => $form_input,
        ]);
    }
}

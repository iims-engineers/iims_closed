<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ApplyRequest;
use App\Mail\MailApplyUser;
use App\Mail\MailApplyAdmin;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

/*
 * ユーザー会員登録申請
 */

class ApplyController extends Controller
{

    // ユーザー登録申請時のデータ
    private $formApply = [
        'name',       // 氏名
        'email',      // メールアドレス
        'past-join',  // 活動参加歴
    ];

    /*
     * ユーザー登録申請 - 入力画面表示
     */
    public function index()
    {
        return view('apply/index');
    }

    /*
     * ユーザー登録申請 - 入力内容のバリデートから確認画面への遷移
     */
    public function apply(ApplyRequest $request)
    {
        // 入力データのバリデート
        $validated = $request->validated();
        $input = $request->only($this->formApply);

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
     * ユーザー登録申請 - 確認画面の表示
     */
    public function applyConfirm(Request $request)
    {
        // セッションから入力データを取得
        $form_input = $request->session()->get('form_input');
        if (empty($form_input)) {
            // セッションに値がなければ入力画面に戻す
            return to_route('apply.index');
        }

        return view('apply/confirm/index', [
            'form_input' => $form_input,
        ]);
    }

    /*
     * ユーザー登録申請 - 登録処理
     */
    public function applyStore(Request $request)
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

            // 完了メール送信(ユーザー側)
            Mail::to($user->email)->send(new MailApplyUser($form_input));
            // 完了メール送信(管理者側)
            Mail::to('admin@test.test')->send(new MailApplyAdmin($form_input));

            // 申請完了画面に遷移
            return to_route('apply.complete');
        } catch (\Exception $e) {
            // 登録失敗したら404を表示
            return to_route('404');
        }
    }

    /**
     * ユーザー登録申請 - 申請完了画面の表示
     */
    public function showComplete()
    {
        return view('apply/complete/index');
    }
}

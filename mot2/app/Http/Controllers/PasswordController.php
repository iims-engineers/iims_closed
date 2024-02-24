<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordNewRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class PasswordController extends Controller
{

    // userモデルのインスタンス格納用
    private $m_user;

    public function __construct()
    {
        $this->m_user = new User();
        return $this->m_user;
    }

    /**
     * 新規パスワード登録 - 入力画面の表示
     * 
     * @param string $token usersテーブルの認証用トークン
     */
    public function showFormNew(string $token)
    {
        if (empty($token)) {
            /* 万が一認証トークンが無いURLだった場合はトップ画面に戻す */
            return to_route('top');
        }
        // 認証トークンからユーザー情報を取得できなければトップ画面に戻す
        $user = $this->m_user->getUserFromToken($token);
        if (!$user) {
            return to_route('top');
        }

        // セッションにユーザー情報をセット
        if (session()->has('user_data')) {
            /* すでにセッションにユーザー情報がある場合は削除してから保存する */
            session()->forget('user_data');
        }
        session()->put(['user_data' => $user]);

        return view('password/new/index', [
            'user' => $user,
        ]);
    }

    /**
     * 新規パスワード登録 - 登録実行
     */
    public function storeNew(PasswordNewRequest $request)
    {
        // 入力データのバリデート
        $validated = $request->validated();
        // 入力データを取得
        $input = $request->only([
            'password',
            'password_confirmation',
        ]);
        // セッションから該当ユーザーの情報を取得
        $user = session()->get('user_data');

        // 登録実行
        try {
            $user->password = Hash::make($input['password']);
            $user->save();

            // 登録成功したらログインフォームに遷移
            // ※なぜか「to_route('password.new.complete');」が正常動作しないので、直接viewを返却しておく
            // return to_route('password.new.complete');
            return view('password/new/complete');
        } catch (\Exception $e) {
            // 登録失敗したら再度入力フォームに戻してやり直させる
            session()->flash('flash_message', __('passwords.regist_error'));
            return back();
        }
    }

    /**
     * 新規パスワード登録 - 完了画面の表示
     */
    // public function completeNew()
    // {
    //     return view('password/new/complete');
    // }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

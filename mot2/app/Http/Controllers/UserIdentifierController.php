<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserIdentifierRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailPasswordResetMailCheck;
use Carbon\Carbon;
use App\Models\User;

class UserIdentifierController extends Controller
{
    // userモデルのインスタンス格納用
    private $m_user;

    public function __construct()
    {
        $this->m_user = new User();
        return $this->m_user;
    }

    /**
     * ユーザーID設定 - 入力画面の表示
     * 
     * @param string $token usersテーブルの認証用トークン
     */
    public function showForm(string $token)
    {
        if (empty($token)) {
            /* 万が一認証トークンが無いURLだった場合はトップ画面に戻す */
            return to_route('top');
        }
        // 認証トークンからユーザー情報を取得できなければトップ画面に戻す
        $user = $this->m_user->getUserByToken($token);
        if (!$user) {
            return to_route('top');
        }

        return view('identifier/index', [
            'user' => $user,
        ]);
    }

    /**
     * ユーザーID設定 - 登録実行
     */
    public function store(UserIdentifierRequest $request)
    {
        // 入力データのバリデート
        $validated = $request->validated();
        // 入力データを取得
        $input = $request->only([
            'id',
            'user_identifier'
        ]);
        // セッションから該当ユーザーの情報を取得
        $user = $this->m_user->getUserById((int)$input['id']);

        // 登録実行
        try {
            $user->user_identifier = Arr::get($input, 'user_identifier');
            $user->save();

            // 登録成功したら完了画面に遷移
            return to_route('identifier.show.complete');
        } catch (\Exception $e) {
            return back();
        }
    }

    /**
     * ユーザーID設定 - 完了画面の表示
     */
    public function showComplete()
    {
        return view('identifier.complete.index');
    }
}

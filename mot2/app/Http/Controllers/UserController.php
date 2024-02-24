<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class UserController extends Controller
{
    // userモデルのインスタンス格納用
    private $m_user;
    // 全ユーザー情報
    private $all_users;

    public function __construct()
    {
        // userモデルのインスタンスを生成
        $this->m_user = new User();
        // 全ユーザー情報を取得
        $this->all_users = $this->m_user->getAllUsers();
    }

    /**
     * ユーザー情報 - 一覧画面の表示
     */
    public function index()
    {
        return view('user/index', [
            'users' => $this->all_users,
        ]);
    }
}

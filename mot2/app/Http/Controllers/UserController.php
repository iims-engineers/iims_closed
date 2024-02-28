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
    public function showList()
    {
        return view('user/index', [
            'users' => $this->all_users,
        ]);
    }

    /**
     * ユーザー情報 - 詳細画面の表示
     * 
     * @param string $id  ユーザーID
     */
    public function detail(string $id)
    {
        $user = '';
        // IDを元にユーザー情報を取得
        if (!empty($id)) {
            // ユーザーIDをstring→intにキャスト
            $id = intval($id);
            $tmp_user = $this->m_user->getUserById($id);
            // 扱いやすいようにobject→arrayに変換
            $user = $tmp_user->attributesToArray();
        } else {
            /* URLにユーザーIDが含まれない場合は前の画面に戻す */
            return to_route('user.list');
        }

        return view('user/detail', [
            'user' => $user,
        ]);
    }
}

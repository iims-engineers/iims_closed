<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Topic;

/**
 * ユーザー情報関連のコントローラ
 */
class UserController extends Controller
{
    // userモデルのインスタンス格納用
    private $m_user;
    // topicモデルのインスタンス格納用
    private $m_topic;
    // 全ユーザー情報
    private $all_users;

    public function __construct()
    {
        // userモデルのインスタンスを生成
        $this->m_user = new User();
        // topicモデルのインスタンスを生成
        $this->m_topic = new Topic();
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
    public function showDetail(string $id)
    {
        /* IDを元にユーザー情報を取得 */
        $user = '';
        if (!empty($id)) {
            // ユーザーIDをstring→intにキャスト
            $user_id = intval($id);
            $tmp_user = $this->m_user->getUserById($user_id);
            // 扱いやすいようにobject→arrayに変換
            $user = $tmp_user->attributesToArray();
        } else {
            /* URLにユーザーIDが含まれない場合は前の画面に戻す */
            return to_route('user.show.list');
        }

        /* ユーザーIDをもとにそのユーザーが作成したトピックを取得 */
        $topics = $this->m_topic->getTopicByUser($user_id);

        return view('user/show/index', [
            'user' => $user,
            'topics' => $topics,
        ]);
    }

    /**
     * ユーザー情報 - 詳細画面の表示
     * 
     * @param string $id  ユーザーID
     */
    public function showEdit(string $id)
    {
        $user = '';
        // IDを元にユーザー情報を取得
        if (!empty($id)) {
            // ユーザーIDをstring→intにキャスト
            $user_id = intval($id);
            $user = $this->m_user->getUserById($user_id);
        } else {
            /* URLにユーザーIDが含まれない場合は前の画面に戻す */
            return to_route('user.show.list');
        }

        return view('user/edit/index', [
            'user' => $user,
        ]);
    }
}

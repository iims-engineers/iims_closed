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
    // 一覧のデフォルト表示件数
    const SHOW_CNT_USERS = 20;

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
     * 
     * string $page  一覧のページ番号
     */
    public function showList(string $page = null)
    {
        // ページ番号
        $page = (int)$page;
        if ($page <= 0) {
            /* 不正なページ番号(0以下)の場合は1ページに設定 */
            $page = 1;
        }

        // 表示件数
        $limit = self::SHOW_CNT_USERS;
        // 何件目から取得するか設定
        $offset = ($page - 1) * $limit;
        // トピック情報(新しい順)と総件数を取得
        $user_info = $this->m_user->getUsersList($limit, $offset);
        // 取得したトピック情報をトピックと総件数に分ける
        $users = [];
        $total_cnt = 0;
        if (!empty($user_info)) {
            $users = data_get($user_info, 'users');
            $total_cnt = data_get($user_info, 'cnt');
        }

        /* ページネーション */
        // 次のページ番号
        $page_next = '';
        if ($total_cnt > (self::SHOW_CNT_USERS * $page)) {
            $page_next = $page + 1;
        }
        // 前のページ番号
        $page_previous = $page - 1;

        // ログインしているユーザーIDを取得(トピック編集ボタンの表示/非表示に使用)
        $user_id = Auth::id();
        return view('user/index', [
            'users' => $users,
            'total_cnt' => $total_cnt,
            'page' => $page,
            'page_next' => $page_next,
            'page_previous' => $page_previous,
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

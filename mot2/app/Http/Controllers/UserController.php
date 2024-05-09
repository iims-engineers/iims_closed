<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
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
    const SHOW_CNT_USERS = 40;

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
     * ユーザー情報 - 編集画面の表示
     * 
     * @param string $id  ユーザーID
     */
    public function showEdit(string $id)
    {
        $user = '';
        // IDを元にユーザー情報を取得
        if (!empty($id)) {
            // ユーザーIDをstring→intにキャスト
            $user_id = (int)$id;
            $user = $this->m_user->getUserById($user_id);
        } else {
            /* URLにユーザーIDが含まれない場合は前の画面に戻す */
            return to_route('user.show.list');
        }

        return view('user/edit/index', [
            'user' => $user,
        ]);
    }

    /**
     * ユーザー情報 - 更新実行
     * 
     * @param UserRequest $request
     */
    public function store(UserRequest $request)
    {
        // 入力内容をバリデート
        $validated = $request->validated();

        $input = $request->all();
        if (empty($input)) {
            /* 入力情報が無い場合 ※張デートがあるため通常操作ではこの処理は通らない想定 */
            return back();
        } else {
            // 更新対象のユーザーを取得
            $target_user = $this->m_user->getUserById(data_get($input, 'user_id'));
            if (empty($target_user)) {
                /* ユーザーが取得できなければ404(基本ここは通らない想定) */
                return to_route('404');
            }

            /* 更新された情報をセット */
            // ユーザー氏名
            if (!empty($input['name'])) {
                $target_user->name = data_get($input, 'name');
            }
            // ユーザーID
            if (!empty($input['user_identifier'])) {
                // 指定されたユーザーIDが別のユーザーに登録されていないかをチェック
                $flg_pass = $this->m_user->checkUserIdentifier($target_user->id, $input['user_identifier']);
                if (!$flg_pass) {
                    /* 別のユーザーに登録されている場合はエラーメッセージを表示 */
                    session()->flash('flash_failed', __('users.fail.duplicate_identifier'));
                    return back();
                }
                $target_user->user_identifier = data_get($input, 'user_identifier');
            }
            // X(twitter)のURL
            if (!empty($input['sns_x'])) {
                $target_user->sns_x = data_get($input, 'sns_x');
            }
            // FacebookのURL
            if (!empty($input['sns_facebook'])) {
                $target_user->sns_facebook = data_get($input, 'sns_facebook');
            }
            // InstagramのURL
            if (!empty($input['sns_instagram'])) {
                $target_user->sns_instagram = data_get($input, 'sns_instagram');
            }
            // 自己紹介テキスト
            if (!empty($input['introduction_text'])) {
                $target_user->introduction_text = data_get($input, 'introduction_text');
            }
            /* 画像は更新がある場合のみ`/storage/app/public/profiles`に保存する */
            // ユーザーアイコン(プロフィール画像)
            if (!empty($input['user_icon'])) {
                // 現在の画像を削除する処理
                $old_icon_path = $target_user->user_icon;
                Storage::disk('public')->delete('icon/', $old_icon_path);
                // 新しい画像を保存
                $target_user->user_icon = data_get($input, 'user_icon')->store('public/icon');
            }
            if (!empty($input['user_cover_image'])) {
                // 現在の画像を削除する処理
                $old_cover_path = $target_user->user_cover_image;
                Storage::disk('public')->delete('cover/', $old_cover_path);
                // 新しい画像を保存
                $target_user->user_cover_image = data_get($input, 'user_cover_image')->store('public/cover');
            }

            // 登録実行
            // try {
            // データベースに保存
            $target_user->save();
            // 詳細画面に遷移
            return to_route('user.show.detail', ['id' => data_get($target_user, 'id')]);
            // } catch (\Exception $e) {
            //     // 登録失敗したら404を表示
            //     return to_route('404');
            // }
        }
    }
}

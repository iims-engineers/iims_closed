<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AnnouncementRequest;
use Illuminate\Support\Arr;
use App\Models\User;
use App\Models\Announcement;
use App\Models\AnnouncementRead;

class AnnouncementController extends Controller
{
    /**
     * お知らせ - 一覧画面の表示
     */
    public function showList($page = 1)
    {
        // お知らせ取得
        $m_announcement = new Announcement();
        $announcement_list = $m_announcement->get_announcements();

        foreach ($announcement_list as $key => $val) {
            if ($val->is_public === '1') {
                $announcement_list[$key]->pub_status = '公開中';
            } else {
                $announcement_list[$key]->pub_status = '非公開';
            }
        }
        return view('admin/announcement/index', [
            'announcement_list' => $announcement_list,
        ]);
    }

    /**
     * お知らせ - 詳細画面の表示
     * 
     * @param string|null $id  トピックID
     */
    public function showDetail(string|null $id)
    {
    }

    /**
     * お知らせ - 新規作成画面の表示
     */
    public function showCreate()
    {
        // 作成者
        $user_id = Auth::id();

        return view('admin/announcement/new/index', [
            'user_id' => $user_id,
        ]);
    }

    /**
     * お知らせ - 保存
     */
    public function store(AnnouncementRequest $request)
    {
        // 入力データのバリデート
        $validated = $request->validated();
        $input = $request->all();

        // 公開ステータスの確認 1:公開中
        if (strtotime('now') >= strtotime(Arr::get($input, 'pub-start'))) {
            $flg_public = 1;
        } else {
            $flg_public = 0;
        }

        $m_announcements = new Announcement();
        $m_announcements->title = Arr::get($input, 'announcement-title');
        $m_announcements->content = Arr::get($input, 'announcement-detail');
        $m_announcements->user_id = Arr::get($input, 'user_id');
        $m_announcements->pub_start_at = Arr::get($input, 'pub-start');
        $m_announcements->pub_end_at = Arr::get($input, 'pub-end');
        $m_announcements->is_public = $flg_public;

        // 登録実行
        try {
            // データベースに保存
            $m_announcements->save();

            // 申請完了画面に遷移
            return to_route('admin.show.announcement.list');
        } catch (\Exception $e) {
            // 登録失敗したら入力画面に戻る
            return back();
        }
    }
}

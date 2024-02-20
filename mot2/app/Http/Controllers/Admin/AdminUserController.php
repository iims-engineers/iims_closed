<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ApplyRequest;
use App\Mail\MailApprovedUser;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class AdminUserController extends Controller
{
    // userモデルのインスタンス
    public $m_user;

    public function __construct()
    {
        return $this->m_user = new User();
    }

    /*
     * 承認待ちユーザー - 一覧表示
     */
    public function showUnapprovedUserList()
    {
        // 承認待ちのユーザー情報を取得
        $unapproved_users = $this->m_user->getUnapprovedUser();

        return view('admin/user/unapproved/list', [
            'users' => $unapproved_users,
        ]);
    }

    /*
     * 承認待ちユーザー - 一覧表示
     * 
     * @param int $id ユーザーID
     */
    public function showUnapprovedUserDetail(int $id)
    {
        $unapproved_user = $this->m_user::where('id', $id)->first();

        if (!empty($unapproved_user)) {
            return view('admin/user/unapproved/detail', [
                'user' => $unapproved_user,
            ]);
        } else {
            return to_route('404');
        }
    }

    /*
     * 承認待ちユーザー - 承認処理
     */
    public function approve(Request $request)
    {
        // IDをもとにユーザー情報を取得
        $id = $request->post('id');
        $user = $this->m_user::where('id', $id)->first();

        if (!empty($user)) {
            try {
                // 承認ステータスを更新
                $user->update([
                    'is_approved' => 1,
                ]);
                // ユーザーに承認完了通知を送信
                Mail::to($user->email)->send(new MailApprovedUser($user));

                // 処理が完了したら承認待ちユーザー一覧画面に遷移
                return to_route('admin.unapprovedUser.list');
            } catch (\Exception $e) {
                // 登録失敗したら元の画面に戻る
                return back();
            }
        } else {
            /* ユーザー情報が取得できなかった場合は元の画面に戻す */
            return to_route('admin.unapprovedUser.list');
        }
    }
}

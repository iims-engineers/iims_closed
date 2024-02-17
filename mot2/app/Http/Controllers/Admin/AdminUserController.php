<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ApplyRequest;
use App\Mail\MailApplyUser;
use App\Mail\MailApplyAdmin;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class AdminUserController extends Controller
{
    //

    /*
     * 承認待ちユーザー一覧表示
     */
    public function showUnapprovedUserList()
    {
        // userモデルのインスタンスを生成
        $m_user = new User();
        // 承認待ちのユーザー情報を取得
        $unapproved_users = $m_user->getUnapprovedUser();

        return view('admin/user/unapproved', [
            'users' => $unapproved_users,
        ]);
    }
}

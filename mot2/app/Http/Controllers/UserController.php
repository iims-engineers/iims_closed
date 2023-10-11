<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /*
     * ユーザー一覧
     */
    public function list()
    {
        echo 'ユーザー一覧です';
    }
    /*
     * ユーザー一覧
     */
    public function show()
    {
        echo 'ユーザー一覧';
    }

    /*
     * ユーザー新規作成
     */
    public function create()
    {
        echo 'ユーザー新規登録';
    }

    /*
     * ユーザー編集
     */
    public function edit()
    {
        echo 'ユーザー一覧です';
    }

    /*
     * ユーザー削除
     */
    public function delete()
    {
        echo 'ユーザー削除';
    }
}

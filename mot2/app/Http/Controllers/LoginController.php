<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
     * ログイン - ログインフォーム表示
     */
    public function index()
    {
        return view('login/index');
    }
}

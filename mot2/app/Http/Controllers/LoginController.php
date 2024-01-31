<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //

    public function showLogin()
    {
        return view('login/index');
    }

    public function login(Request $request)
    {
        echo "OK";
        // $user_info = $request->validate([
        //     'email' => ['required', 'email'],
        //     'password' => ['required'],
        // ]);

        // // ログインに成功したとき
        // if (Auth::attempt($user_info)) {
        //     $request->session()->regenerate();
        //     return view('home/index');
        // }

        // // 上記のif文でログインに成功した人以外(=ログインに失敗した人)がここに来る
        // return redirect()->back();
    }
}

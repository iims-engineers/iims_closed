<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /*
     * ユーザー新規登録画面の表示
     */
    public function showRegister()
    {
        return view('apply/index');
    }

    /*
     * ユーザー新規登録処理
     */
    public function register(Request $request)
    {
        $user = User::query()->create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password'])
        ]);

        Auth::login($user);

        return redirect()->route('profile');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    /**
     * ログイン画面表示
     */
    public function showLogin()
    {
        // ログインしていればホームへ遷移 していなければログイン画面を表示
        return view('login/index');
    }

    /**
     * ログイン実行
     */
    public function login(Request $request)
    {
        $user_info = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // ログインに成功したとき
        if (Auth::attempt($user_info)) {
            $request->session()->regenerate();
            echo "ログイン成功しました。";
            exit;
        } else {
            echo "ログイン失敗しました。";
            exit;
        }

        // 上記のif文でログインに成功した人以外(=ログインに失敗した人)がここに来る
        // return redirect()->back();
    }

    /**
     * ログアウト
     */
    public function logout()
    {
        Auth::logout();
        return view('about/index');
    }
}

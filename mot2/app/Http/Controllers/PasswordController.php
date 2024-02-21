<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordNewRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class PasswordController extends Controller
{

    // userモデルのインスタンス格納用
    private $m_user;

    public function __construct()
    {
        $this->m_user = new User();
        return $this->m_user;
    }

    /**
     * パスワード新規登録画面の表示
     * 
     * @param int $id ユーザーID
     */
    public function indexNew(int $id)
    {
        if (empty($id)) {
            /* パラメータにユーザーIDがなかったら404 */
            return to_route('404');
        }

        return view('password/new/index', [
            'id' => $id,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PasswordNewRequest $request)
    {
        // 入力データのバリデート
        $validated = $request->validated();
        // 入力データを取得
        $input = $request->only([
            'password',
            'password_confirmation',
            'user-id',
        ]);

        dump($input);
        exit;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

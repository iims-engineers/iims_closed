<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    // テーブル名の定義
    protected $table = 'users';

    /**
     * 登録や更新を許可しないカラムを設定
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * カラムの型定義(データ取得時に指定の型で取得する)
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'integer',
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_admin' => 'integer',
        'is_approved' => 'integer',
    ];

    /*
     * ユーザー情報一括取得
     */
    public function getAllUser()
    {
        // 削除されていない全ユーザーをid順に取得
        $all_users = DB::table($this->table)
            ->whereNull('deleted_at')
            ->orderBy('id', 'asc')
            ->get();

        return $all_users;
    }

    /*
     * 承認待ちユーザーを全て取得
     */
    public function getUnapprovedUsers()
    {
        // 承認待ちユーザーを取得
        $unapproved_users = DB::table($this->table)
            ->where('is_approved', 0)
            ->whereNull('deleted_at')
            ->get();

        return $unapproved_users;
    }

    /*
     * ユーザーの承認処理
     * 
     * @param int $id  承認するユーザーのID
     * @return void
     */
    public function approveUser(int $id)
    {
        // 承認待ちユーザーを取得
        $user = $this->where('id', $id)->first();
        // 承認ステータスを1(承認済)に設定
        $user->is_approved = 1;
        // 変更を保存
        $user->save();
    }

    /*
     * 承認待ちユーザーの情報を取得
     * 
     * @param int $id  確認するユーザーのID
     * @return         未承認の場合true, 承認済みの場合false
     */
    public function getUnapprovedUser(int $id)
    {
        $res = null;
        // IDと承認ステータスを元にユーザー情報を取得
        $res = $this->where([
            ['id', '=', $id],
            ['is_approved', '=', 0],
        ])->whereNull('deleted_at')
            ->first();

        return $res;
    }
}

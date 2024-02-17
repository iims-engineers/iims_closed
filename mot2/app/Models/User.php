<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
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
     * 承認待ちユーザーの取得
     */
    public function getUnapprovedUser()
    {
        // 承認待ちユーザーを取得
        $unapproved_users = DB::table($this->table)
            ->where('is_approved', 0)
            ->whereNull('deleted_at')
            ->get();

        return $unapproved_users;
    }
}

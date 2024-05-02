<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
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
        'verify_token' => 'string',
        'is_admin' => 'integer',
        'is_approved' => 'integer',
    ];

    /**
     * ユーザー情報一括取得
     * 
     * @param bool $except true→特定のユーザー(自分)を取得対象から外す
     * @param int  $id     取得対象から外すユーザーのID
     */
    public function getAllUsers(bool $except = false, int $id = null)
    {
        // 削除されていない承認済みのユーザーをid順に取得
        $query = $this->where('is_approved', 1)
            ->whereNull('deleted_at');
        if ($except) {
            /* 特定のユーザーを取得対象から外す場合 */
            $query = $query->where('id', '!=', $id);
        }
        $users = $query->orderBy('id', 'asc')
            ->get();

        return $users;
    }

    /**
     * ユーザー一覧に表示する情報を取得
     * 
     * @param int|null $limit   取得件数
     * @param int|null $offset  取得開始レコード数
     */
    public function getUsersList(int|null $limit = null, int|null $offset = null): array
    {
        /* トピック取得 */
        $user_info = [];
        $query = DB::table($this->table)
            ->whereNull('users.deleted_at')
            ->orderBy('users.created_at', 'desc');
        if (!empty($limit)) {
            /* 取得件数の設定 */
            $query = $query->limit($limit);
        }
        if (!empty($offset)) {
            /* 何件目から取得するか設定 */
            $query = $query->offset($offset);
        }
        $user_info['users'] = $query->get()->toArray();

        /* トータル件数取得 */
        $user_info['cnt'] = DB::table($this->table)
            ->whereNull('users.deleted_at')
            ->count();

        return $user_info;
    }

    /**
     * IDからユーザーの情報を取得
     * 
     * @param int $id  ユーザーID
     * @return $user
     */
    public function getUserById(int $id)
    {
        // IDを元に承認済みのユーザー情報を取得
        $user = $this->where([
            ['id', '=', $id],
            ['is_approved', '=', 1],
        ])
            ->whereNull('deleted_at')
            ->first();

        return $user;
    }

    /**
     * メールアドレスからユーザーの情報を取得
     * 
     * @param string $email  メールアドレス
     * @return $user
     */
    public function getUserByEmail(string $email)
    {
        // メールアドレスを元に承認済みのユーザー情報を取得
        $user = $this->where([
            ['email', '=', $email],
            ['is_approved', '=', 1],
        ])
            ->whereNull('deleted_at')
            ->first();

        return $user;
    }

    /**
     * ユーザーID(user_identifier)の重複チェック
     * 指定のユーザーIDが別のユーザーに登録されていたらfalseを返す
     * 
     * @param int|string $user_id usersテーブルのid
     * @param string $user_identifier usersテーブルのuser_identifier
     * @return bool
     */
    public function checkUserIdentifier(int|string $user_id, string $user_identifier)
    {
        $res = false;
        $ret = DB::table('users')
            ->whereNot('id', $user_id)
            ->where('user_identifier', $user_identifier)
            ->whereNull('deleted_at')
            ->first();

        if (empty($ret)) {
            /* ユーザーIDが別のユーザーに登録されていなければtrueを返却 */
            $res = true;
        }

        return $res;
    }

    /**
     * 承認待ちユーザーを全て取得
     */
    public function getUnapprovedUsers()
    {
        // 承認待ちユーザーを取得
        $unapproved_users = $this->where('is_approved', 0)
            ->whereNull('deleted_at')
            ->get();

        return $unapproved_users;
    }

    /**
     * ユーザーの承認処理
     * 
     * @param int $id  承認するユーザーのID
     * @return void
     */
    public function approveUser($id)
    {
        // 承認待ちユーザーを取得
        $user = $this->where('id', $id)
            ->first();
        // 承認ステータスを1(承認済)に設定
        $user->is_approved = 1;
        // 変更を保存
        $user->save();
    }

    /**
     * 承認待ちユーザーの情報を取得
     * 
     * @param int $id  確認するユーザーのID
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

    /**
     * 認証用トークンからユーザー情報を取得する
     * 
     * @param string $token  認証用トークン
     */
    public function getUserByToken(string $token)
    {
        $user = $this->where([
            'verify_token' => $token,
        ])->whereNull('deleted_at')
            ->first();

        if (!empty($user)) {
            // 認証トークンをデコードしてメールアドレスとの一致確認
            $decoded_token = base64_decode($token);
            if ($decoded_token === $user->email) {
                /* 一致したらユーザー情報を返す */
                return $user;
            }
        }
        // ユーザー情報が取得できないかメールアドレスと一致しない場合はfalseを返す
        return false;
    }

    /**
     * パスワード再設定キーからユーザー情報を取得
     * 
     * @param string $reset_token パスワード再設定キー
     */
    public function getUserByResetPasswordAccessKey(string $reset_token)
    {
        $user = $this->where('reset_password_access_key', $reset_token)
            ->whereNull('deleted_at')
            ->first();

        return $user;
    }
}

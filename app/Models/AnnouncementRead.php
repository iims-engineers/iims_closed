<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AnnouncementRead extends Model
{
    use HasFactory;

    const NOT_PUBLIC = 0;
    const IS_PUBLIC = 1;

    // テーブル名の定義
    protected $table = 'announcement_reads';

    /**
     * お知らせIDをもとに、既読のお知らせIDと数を取得
     */
    public function getCount(string|int $user_id)
    {
        $res = [];
        // 既読のお知らせID
        $res['id'] = DB::table($this->table)
            ->select('announcement_id')
            ->where('user_id', $user_id)
            ->where('is_public', 1)
            ->get()
            ->toArray();

        // 既読数
        $res['read_count'] = count($res['id']);

        return $res;
    }

    /**
     * お知らせを既読にする
     * 
     * @param string|int $announcement_id 既読にするお知らせID
     * @return bool  true:更新成功 or 既に既読
     */
    public function storeReadStatus(string|int $announcement_id)
    {
        // ユーザーID
        $user_id = Auth::id();

        $ret = DB::table($this->table)
            ->where('user_id', $user_id)
            ->where('announcement_id', $announcement_id)
            ->get()
            ->toArray();

        if (empty($ret)) {
            /* 未読の場合のみDB更新 */
            try {
                DB::table($this->table)
                    ->insert([
                        'user_id' => $user_id,
                        'announcement_id' => $announcement_id,
                    ]);
                return true;
            } catch (\Exception $e) {
                return false;
            }
        } else {
            return true;
        }
    }

    /**
     * お知らせ公開状況によってis_publicカラムを更新
     * 
     * @param string|int $announcement_id 削除するお知らせID
     * @param int $flg 1:公開中に変更する
     * @return
     */
    public function _update(string|int $announcement_id, int $flg)
    {
        $ret = DB::table($this->table)
            ->where('announcement_id', $announcement_id)
            ->limit(1)
            ->get()
            ->toArray();

        if ($flg === self::IS_PUBLIC) {
            $from_public = self::NOT_PUBLIC;
            $to_public = self::IS_PUBLIC;
        }
        if ($flg === self::NOT_PUBLIC) {
            $from_public = self::IS_PUBLIC;
            $to_public = self::NOT_PUBLIC;
        }
        if (!empty($ret)) {
            try {
                DB::table($this->table)
                    ->where('announcement_id', $announcement_id)
                    ->where('is_public', $from_public)
                    ->update(['is_public' => $to_public]);
            } catch (\Exception $e) {
                // 登録失敗したら入力画面に戻る
                return to_route('404');
            }
        }
        return;
    }
}

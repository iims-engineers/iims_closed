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
     * お知らせ削除時のDB削除
     * 
     * @param string|int $announcement_id 削除するお知らせID
     * @return
     */
    // public function _delete(string|int $announcement_id)
    // {
    //     try {
    //         $this->where('id', $announcement_id)
    //             ->delete();
    //         return true;
    //     } catch (\Exception $e) {
    //         // 登録失敗したら入力画面に戻る
    //         return to_route('404');
    //     }
    // }
}

<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\AnnouncementRead;

class Announcement extends Model
{
    use HasFactory;

    // テーブル名の定義
    protected $table = 'announcements';

    /**
     * カラムの型定義(データ取得時に指定の型で取得する)
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'content' => 'string',
        'user_id' => 'integer',
    ];

    /**
     * お知らせ取得
     * 
     * @param  bool  $only_id IDのみを取得する場合はtrue
     * @param  array  $target 取得したいお知らせID
     * @return array $res
     */
    public function getAnnouncements(bool $only_id = false, string|array $target = []): array
    {
        $query = DB::table($this->table);
        if ($only_id === false) {
            $query->select();
        } else {
            $query->select('id');
        }
        if (!empty($target)) {
            /* 指定のIDがある場合 */
            $query->where('id', $target);
        }
        $res = $query->whereNull('deleted_at')
            ->where('is_public', 1)
            ->get()
            ->toArray();
        return $res;
    }

    /**
     * 公開中のお知らせを公開ステータスと既読数を含めて取得
     * 
     * @param bool $only_id IDのみを取得する場合はtrue
     */
    public function getStatusRead(string|int $user_id)
    {
        // 公開中のお知らせIDを取得
        $ids = self::getAnnouncements(true);

        // 公開中お知らせの中で既読数を取得
        $m_announcement_read = new AnnouncementRead();
        $read_info = $m_announcement_read->getCount($user_id);

        // お知らせリストに既読のステータスを追加 ※未読の場合はキー自体作成しない
        $announcement_list['unread_count'] = count($ids) - data_get($read_info, 'read_count');
        $announcement_list['announcement'] = self::getAnnouncements();
        foreach ($announcement_list['announcement'] as $a_key => $a_val) {
            foreach (data_get($read_info, 'id', []) as $r_key => $r_id)
                if ($a_val->id === data_get($r_id, 'announcement_id')) {
                    /* 既読 */
                    $announcement_list['announcement'][$a_key]->pub_status = 1;
                }
        }

        return $announcement_list;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Comment;

class Topic extends Model
{
    use HasFactory;

    // テーブル名の定義
    protected $table = 'topics';

    /**
     * 登録や更新を許可しないカラムを設定
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

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

    // 表示用カラム
    private $columns = [
        'topics.id',
        'topics.title',
        'topics.content',
        'topics.user_id',
        'topics.created_at',
        'topics.updated_at',
        'users.name',
        'users.user_icon',
        'users.user_identifier',
    ];

    /**
     * トピック情報一括取得(投稿日時が新しい順)
     * 
     * @param int $limit   取得件数
     * @param bool|null $flg_cnt    全件数を取得するかのフラグ
     */
    public function getTopics(int $limit = 0)
    {
        // 削除されていないトピックを作成日時が新しい順に取得
        $query = DB::table($this->table)
            ->join('users', 'topics.user_id', '=', 'users.id')
            ->select($this->columns)
            ->whereNull('topics.deleted_at')
            ->orderBy('topics.created_at', 'desc');
        if (!empty($limit)) {
            /* 取得件数の設定 */
            $query = $query->limit($limit);
        }

        $topics = $query->get();

        return $topics;
    }

    /**
     * トピック一覧画面表示用(投稿日時が新しい順)
     * 
     * @param int|null $limit   取得件数
     * @param int|null $offset  取得開始レコード数
     */
    public function getTopicsList(int|null $limit = null, int|null $offset = null): array
    {
        // 削除されていないトピックを作成日時が新しい順に取得
        $topic_info = [];
        $query = DB::table($this->table)
            ->join('users', 'topics.user_id', '=', 'users.id')
            ->select($this->columns)
            ->whereNull('topics.deleted_at')
            ->orderBy('topics.created_at', 'desc');
        if (!empty($limit)) {
            /* 取得件数の設定 */
            $query = $query->limit($limit);
        }
        if (!empty($offset)) {
            /* 何件目から取得するか設定 */
            $query = $query->offset($offset);
        }
        $topic_info['topics'] = $query->get()->toArray();
        // 件数取得
        $topic_info['cnt'] = DB::table('topics')
            ->join('users', 'topics.user_id', '=', 'users.id')
            ->select('topics.id')
            ->whereNull('topics.deleted_at')
            ->count();

        return $topic_info;
    }

    /**
     * IDをもとにトピック情報を取得
     * 
     * @param int|string $id  トピックID
     */
    public function getTopicById(int|string $topic_id)
    {
        $topic = DB::table($this->table)
            ->join('users', 'topics.user_id', '=', 'users.id')
            ->select($this->columns)
            ->where('topics.id', $topic_id)
            ->whereNull('topics.deleted_at')
            ->first();

        return $topic;
    }

    /**
     * ユーザーIDをもとにそのユーザーが作成したトピックを取得
     * 
     * @param int $user_id  ユーザーID
     */
    public function getTopicByUser(int $user_id)
    {
        $topic = DB::table($this->table)
            ->join('users', 'topics.user_id', '=', 'users.id')
            ->select($this->columns)
            ->where('topics.user_id', $user_id)
            ->whereNull('topics.deleted_at')
            ->get();

        return $topic;
    }

    /**
     * IDをもとにトピック情報を論理削除
     * ※物理削除はせず`deleted_at`カラムに削除日時を保存する処理
     * 
     * @param int $id  トピックID
     */
    public function deleteTopic(int $topic_id)
    {
        /* IDをもとにトピック取得 */
        $topic = $this->where('id', $topic_id)
            ->whereNull('deleted_at')
            ->first();

        if (empty($topic)) {
            /* 存在しないIDまたは削除済み */
            return false;
        }

        /* 紐づくコメントも削除する */
        $comments = DB::table('comments')
            ->where('topic_id', $topic_id)
            ->whereNull('deleted_at')
            ->get();

        // 削除日時を取得しておく
        $deleted_time = now();

        /* トピック削除実行 */
        try {
            // 削除日時
            $topic->deleted_at = $deleted_time;
            // 論理削除実行
            $topic->save();
        } catch (\Exception $e) {
            return false;
        }

        if ($comments->isNotEmpty()) {
            /* コメント削除実行 */
            foreach ($comments as $comment) {
                try {
                    // 削除日時
                    $comment->deleted_at = $deleted_time;
                    // 論理削除実行
                    $comment->save();
                } catch (\Exception $e) {
                    return false;
                }
            }
        }

        return true;
    }
}

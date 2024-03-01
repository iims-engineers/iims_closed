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

    // 一覧表示に使用するデータカラム
    private $columns = [
        'topics.id',
        'topics.title',
        'topics.content',
        'topics.user_id',
        'topics.created_at',
        'topics.updated_at',
        'users.name',
    ];

    /**
     * トピック情報一括取得(投稿日時が新しい順)
     * 
     */
    public function getAllTopics()
    {
        // 削除されていない承認済みのユーザーをid順に取得
        $topics = DB::table('topics')
            ->join('users', 'topics.user_id', '=', 'users.id')
            ->select($this->columns)
            ->whereNull('topics.deleted_at')
            ->orderBy('topics.created_at', 'desc')
            ->get();

        return $topics;
    }

    /**
     * IDをもとにトピック情報を取得
     * 
     * @param int $id  トピックID
     */
    public function getTopicById(int $topic_id)
    {
        $topic = DB::table('topics')
            ->join('users', 'topics.user_id', '=', 'users.id')
            ->select($this->columns)
            ->where('topics.id', $topic_id)
            ->whereNull('topics.deleted_at')
            ->first();

        return $topic;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Topic;

class Comment extends Model
{
    use HasFactory;

    // テーブル名の定義
    protected $table = 'comments';

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
        'comment' => 'string',
        'topic_id' => 'integer',
        'user_id' => 'integer',
    ];

    // 表示用カラム
    private $columns = [
        'comments.id',
        'comments.comment',
        'comments.created_at',
        'topics.id as topic_id',
        'users.id as user_id',
        'users.name as username',
        'users.user_icon',
        'users.user_identifier',
    ];

    /**
     * トピックに紐づくコメントを取得
     * 
     * @param int|string $topic_id  トピックID
     */
    public function getCommentsByTopicID(int|string $topic_id)
    {
        // 古いコメントを上位に表示するため作成日時順に取得
        $comments = DB::table($this->table)
            ->join('users', 'comments.user_id', '=', 'users.id')
            ->join('topics', 'comments.topic_id', '=', 'topics.id')
            ->select($this->columns)
            ->whereNull('comments.deleted_at')
            ->orderBy('comments.created_at', 'asc')
            ->get();

        return $comments;
    }
}

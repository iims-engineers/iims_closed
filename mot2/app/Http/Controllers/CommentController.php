<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use App\Models\Comment;
use App\Models\User;
use App\Models\Topic;


/**
 * トピックへのコメント関連のコントローラ
 */
class CommentController extends Controller
{

    // commentモデルのインスタンス格納用
    private $m_comment;
    // topicモデルのインスタンス格納用
    private $m_topic;
    // userモデルのインスタンス格納用
    private $m_user;

    public function __construct()
    {
        // commentモデルのインスタンス生成
        $this->m_comment = new Comment();
        // topicモデルのインスタンス生成
        $this->m_topic = new Topic();
        // userモデルのインスタンス生成
        $this->m_user = new User();
    }

    /**
     * コメント入力画面の表示
     * 
     * @param int|string $topic_id  コメントするトピックのID
     */
    public function showForm(int|string $topic_id = null)
    {
        // URLにトピックIDがなかったら404
        if (empty($topic_id)) {
            return to_route('404');
        }
        // IDをもとにトピック情報を取得
        $topic = $this->m_topic->getTopicById((int)$topic_id);
        if (empty($topic)) {
            /* 存在しないIDもしくは削除済みの場合は404 */
            return to_route('404');
        }

        // トピックIDから紐づくコメントを取得
        $comments = $this->m_comment->getCommentsByTopicID($topic_id);

        // コメント主の情報
        $user = Auth::user();

        return view('topic/comment/index', [
            'topic' => $topic,
            'comments' => $comments,
            'user' => $user,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}

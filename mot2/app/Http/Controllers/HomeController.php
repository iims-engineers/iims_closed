<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Topic;
use App\Models\Comment;
use App\Models\Support;

/**
 * ログイン後のTOP画面
 *  ・トピック最新5件表示
 *  ・運営への問い合わせ(メッセージ)フォーム
 */
class HomeController extends Controller
{
    // ホーム画面に表示するトピック数
    const CNT_SHOW_TOPIC = 5;
    // userモデルのインスタンス
    private $m_user;
    // topicモデルのインスタンス
    private $m_topic;
    // commentモデルのインスタンス
    private $m_comment;
    // supportモデルのインスタンス
    private $m_support;

    public function __construct()
    {
        // // userモデルのインスタンス生成
        $this->m_user = new User();
        // topicモデルのインスタンス生成
        $this->m_topic = new Topic();
        // commentモデルのインスタンス生成
        $this->m_comment = new Comment();
        // supportモデルのインスタンス生成
        $this->m_support = new Support();
    }

    /**
     * ホーム画面の表示
     */
    public function index()
    {
        // ログインしているユーザー
        $user_id = Auth::id();
        /* 最新のトピックを取得 */
        $topics = $this->m_topic->getTopics(self::CNT_SHOW_TOPIC);

        return view('home/index', [
            'user_id' => $user_id,
            'topics' => $topics,
        ]);
    }
}

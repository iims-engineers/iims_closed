<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Requests\TopicNewRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class TopicController extends Controller
{

    // topicモデルのインスタンス格納用
    private $m_topic;
    // userモデルのインスタンス格納用
    private $m_user;
    // 全ユーザー情報
    private $all_topics;
    // 新規作成・編集の入力項目
    private $form_topic = [
        'topic-title',
        'topic-detail',
    ];

    public function __construct()
    {
        // topicモデルのインスタンス生成
        $this->m_topic = new Topic();
        // userモデルのインスタンス生成
        $this->m_user = new User();
    }

    /**
     * トピック - 一覧画面の表示
     */
    public function showList()
    {
        // トピック情報を投稿日時が新しい順で取得
        $topics = $this->m_topic->getAllTopics();

        return view('topic/show/index', [
            'topics' => $topics,
        ]);
    }

    /**
     * トピック - 詳細画面の表示
     * 
     * @param int $id  トピックID
     */
    // public function showDetail(int $id)
    // {
    //     // IDを元にトピックの詳細を取得
    //     $topic = $this->m_topic->getTopicById($id);

    //     return view('topic/show/detail');
    // }

    /**
     * トピック新規作成 - 入力画面の表示
     */
    public function showForm()
    {
        // ユーザー情報(投稿者)を取得
        $user = Auth::user();

        return view('topic/new/index', [
            'user' => $user,
        ]);
    }

    /**
     * トピック新規作成 - 入力内容の確認、保存実行
     */
    public function newCheck(TopicNewRequest $request)
    {
        // 入力データのバリデート
        $validated = $request->validated();
        // バリデートOKの場合、取得
        $input = $request->only($this->form_topic);

        // 投稿者(ログインしているユーザー)の情報を取得
        $user = Auth::user();

        /* topicテーブルに保存する内容を設定 */
        // タイトル
        $this->m_topic->title = Arr::get($input, 'topic-title');
        // 本文
        $this->m_topic->content = Arr::get($input, 'topic-detail');
        // 投稿者
        $this->m_topic->user_id = $user->id;

        try {
            // 保存実行
            $this->m_topic->save();

            // 投稿完了したらトピック一覧画面に遷移する
            return to_route('topic.show.list');
        } catch (\Exception $e) {
            // 失敗したら入力画面に戻す
            session()->flash('flash_message', __('topics.failed'));
            return back();
        }
    }
}

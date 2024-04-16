<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TopicRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Topic;
use App\Models\Comment;

/**
 * トピック関連のコントローラ
 */
class TopicController extends Controller
{

    // topicモデルのインスタンス格納用
    private $m_topic;
    // userモデルのインスタンス格納用
    private $m_user;
    // commentモデルのインスタンス格納用
    private $m_comment;
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
        // commentモデルのインスタンス生成
        $this->m_comment = new Comment();
    }

    /**
     * トピック - 一覧画面の表示
     */
    public function showList()
    {
        // トピック情報を投稿日時が新しい順で取得
        $topics = $this->m_topic->getAllTopics();

        return view('topic/index', [
            'topics' => $topics,
        ]);
    }

    /**
     * トピック - 詳細画面の表示
     * 
     * @param string|null $id  トピックID
     */
    public function showDetail(string|null $id = null)
    {
        if (empty($id)) {
            /* IDが無い場合は一覧に戻す */
            return to_route('topic.show.list');
        }

        // IDを元にトピックの詳細を取得
        $topic = $this->m_topic->getTopicById((int)$id);

        return view('topic/show/detail', [
            'topic' => $topic,
        ]);
    }

    /**
     * トピック新規作成 - 入力画面の表示
     */
    public function showCreate()
    {
        // ユーザー情報(投稿者)を取得
        $user = Auth::user();

        return view('topic/new/index', [
            'user' => $user,
        ]);
    }

    /**
     * トピック編集 - 編集画面の表示
     * 
     * @param string|null $topic_id  編集するトピックのトピックID
     */
    public function showEdit(?string $topic_id = null)
    {
        if (empty($topic_id)) {
            /* IDが無い場合は一覧に戻す */
            return to_route('topic.show.list');
        }

        // ログインしているユーザー情報を取得
        $user = Auth::user();
        // トピックIDを元にトピック情報を取得
        $topic = $this->m_topic::find((int)$topic_id);

        if (empty($topic) || $user->id !== $topic->user_id) {
            /* IDが不正、トピック削除済みの場合や、投稿者以外が編集しようとした場合などは404 */
            return to_route('404');
        }

        if ($user->id !== $topic->user_id) {
            /* 投稿者以外は編集できないため一覧に戻す */
            return back();
        }

        return view('topic/edit/index', [
            'topic' => $topic,
            'user' => $user,
        ]);
    }

    /**
     * トピック - 入力内容の確認、保存実行
     */
    public function store(TopicRequest $request)
    {
        // 入力データのバリデート
        $validated = $request->validated();
        // バリデートOKの場合、取得
        $input = $request->all();

        try {

            if (isset($input['id'])) {
                /* 編集の場合はトピック情報を取得 */
                $topic = $this->m_topic::find((int)$input['id']);
            } else {
                /* 新規作成の場合は投稿者のユーザーIDも保存する */
                $topic = $this->m_topic;
                // 投稿者(ログインしているユーザー)の情報を取得
                $user = Auth::user();
                $topic->user_id = $user->id;
            }
            // タイトル
            $topic->title = Arr::get($input, 'topic-title');
            // 本文
            $topic->content = Arr::get($input, 'topic-detail');
            // 保存実行
            $topic->save();

            // 保存完了したらトピック一覧画面に遷移する
            return to_route('topic.show.list');
        } catch (\Exception $e) {
            // 失敗したら入力画面に戻す
            session()->flash('flash_message', __('topics.failed'));
            return back();
        }
    }

    /**
     * トピック - 削除実行
     * 
     * @param int $topic_id 削除対象のトピックID
     */
    public function delete(int $topic_id)
    {
        if (empty($topic_id)) {
            /* IDがない場合は詳細画面に戻す */
            return back();
        }

        // 削除実行
        $failed = $this->m_topic->deleteTopic($topic_id);

        if ($failed) {
            /* 削除完了したらトピック一覧画面に遷移する */
            return to_route('topic.show.list');
        } else {
            /* 失敗したら詳細画面に戻す */
            session()->flash('flash_message', __('topics.failed_delete'));
            return back();
        }
    }
}

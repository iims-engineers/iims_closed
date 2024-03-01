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
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

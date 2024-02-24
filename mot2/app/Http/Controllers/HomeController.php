<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * ホーム画面の表示
     */
    public function index()
    {
        return view('home/index');
    }
}

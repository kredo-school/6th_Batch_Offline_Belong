<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // ユーザーの通知一覧を表示
    public function index()
    {
        // 現在ログインしているユーザーの通知を取得
        $notifications = Auth::user()->notifications;

        // 通知一覧ページに通知データを渡す
        return view('notifications', compact('notifications'));
    }
}

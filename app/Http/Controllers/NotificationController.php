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

        // 未読通知数を取得
        $unreadCount = auth()->user()->unreadNotifications->count();

        // 通知を既読にする（未読通知があった場合）
        auth()->user()->unreadNotifications->markAsRead();

        // 通知一覧ページに通知データと未読通知数を渡す
        return view('notifications', compact('notifications', 'unreadCount'));
    }

    // 特定の通知を既読にする
    public function markNotificationAsRead($notificationId)
    {
        $notification = auth()->user()->notifications()->find($notificationId);

        // 通知が見つかった場合に既読にする
        if ($notification) {
            $notification->markAsRead();
        }

        return redirect()->route('notifications.index');
    }

    

    
}

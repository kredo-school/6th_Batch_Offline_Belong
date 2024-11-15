<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Notifications\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Models\User;

class NotificationsController extends Controller
{
    // 通知送信フォームを表示
    public function create()
    {
        $users = User::all();
        return view('admin.notify', compact('users'));
    }

    // 通知を送信 public function store(Request $request)
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'target' => 'required|in:all,single',
            'message' => 'required|string',
            'user_id' => 'required_if:target,single|exists:users,id',
        ]);

        // 通知メッセージ
        $message = $request->input('message');

        // 通知を送信するユーザーを決定
        if ($request->target == 'all') {
            // 全ユーザーに通知を送信
            $users = User::all();
        } else {
            // 特定のユーザーに通知を送信
            $users = User::where('id', $request->user_id)->get();
        }

        // 通知を送信
        foreach ($users as $user) {
            // 作成した通知を送信
            $user->notify(new UserNotification($message));
        }

        // 成功メッセージ
        return redirect()->route('admin.notify')->with('success', 'Notification sent successfully.');
    }
}

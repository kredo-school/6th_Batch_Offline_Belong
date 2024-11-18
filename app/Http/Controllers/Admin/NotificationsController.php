<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Notifications\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $notifications = Auth::user()->notifications;
        // バリデーション
        $request->validate([
            'target' => 'required|in:all,single',
            'message' => 'required|string|max:255',
        ]);

        $message = $request->input('message');

        if ($request->input('target') === 'all') {
            // 全ユーザーに通知を送信
            $users = User::all();
            foreach ($users as $user) {
                $user->notify(new UserNotification($message));
            }
        } else {
            // 個別ユーザーに通知を送信
            $user = User::find($request->input('user_id'));
            if ($user) {
                $user->notify(new UserNotification($message));
            }
        }

        return redirect()->route('admin.notify')->with('success', 'Notification sent successfully!');
    }
}


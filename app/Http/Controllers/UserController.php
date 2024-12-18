<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function search(Request $request)
    {
        // 検索クエリを取得
        $query = $request->input('query');

        // ユーザー名に基づいて検索
        $users = User::where('name', 'like', "%{$query}%")->get();

        // 検索結果をビューに渡す
        return view('posts.user', compact('users', 'query'));
    }

    public function index()
    {
        // 現在ログインしているユーザーの通知を取得
        $notifications = Auth::user()->notifications;

        // 通知一覧ページに通知データを渡す
        return view('user.notifications.index', compact('notifications'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class UsersController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $all_users = $this->user->latest()->paginate(6);
        return view('admin.users.index')
            ->with('all_users',$all_users);
    }

    public function search(Request $request)
    {
        // 検索クエリを取得
        $search = $request->input('search');

        // 検索クエリがある場合にフィルター
        $all_users = User::where('name', 'LIKE', "%{$search}%")
            ->orWhere('email', 'LIKE', "%{$search}%")
            ->paginate(10);  // ページネーション対応

        // 検索結果をadmin.users.indexビューに渡す
        return view('admin.users.index', compact('all_users'));
    }

    public function destroy($id)
    {
        // 現在のログイン中のユーザー
        $currentUser = auth()->user();

        // 削除対象のユーザー
        $user = User::findOrFail($id);

        // 自分自身の削除を防ぐ
        if ($currentUser->id === $user->id) {
            return redirect()->route('admin.users')->with('error', 'You cannot delete yourself.');
        }

        // ユーザーの削除
        $user->delete();

        // メッセージ付きでリダイレクト
        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }


}

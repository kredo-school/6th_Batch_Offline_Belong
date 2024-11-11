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
        $all_users = $this->user->latest()->paginate(5);
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
        // ユーザーを取得
        $user = User::findOrFail($id);

        // ユーザーの削除
        $user->delete();

        // メッセージ付きでリダイレクト
        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }
    
}
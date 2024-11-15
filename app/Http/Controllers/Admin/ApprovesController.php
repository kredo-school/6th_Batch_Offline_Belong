<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class ApprovesController extends Controller
{
    // 保留中の投稿の一覧を表示するメソッド
    public function index()
    {
        // 承認されていないポストのみを取得
        $pendingPosts = Post::where('approved', false)->paginate(6);  // 'approved' フィールドを使って承認されていないポストを取得

        return view('admin.approve', compact('pendingPosts'));
    }
}

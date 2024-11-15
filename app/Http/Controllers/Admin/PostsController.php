<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category; // Categoryモデルをインポート
use Auth;

class PostsController extends Controller
{
    private $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function index()
    {
        $all_posts = Post::where('approved', true)->latest()->paginate(10);
        return view('admin.posts.index')->with('all_posts', $all_posts);
    }

    public function approve($id)
    {
        // ポストを取得
        $post = Post::findOrFail($id);

        // 承認処理
        $post->approved = true;  // フィールド名が 'approved' と仮定
        $post->save();

        // 承認後、承認されていないポストのみを表示
        return redirect()->route('admin.approve.page')->with('message', 'Post approved successfully!');
    }

    public function reject($id)
    {
        // ポストをデータベースから取得
        $post = Post::findOrFail($id);

        // ポストをリジェクト（承認フラグを-1に設定）
        $post->approved = 2;

        // 変更をデータベースに保存
        $post->save();

        // ユーザーのプロフィールページにリダイレクト
        return redirect()->route('admin.approve.page')->with('message', 'Post rejected!');
    }



}

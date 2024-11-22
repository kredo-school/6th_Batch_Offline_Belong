<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\PostRejected;
use App\Notifications\PostApproveNotification;
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

        $post->user->notify(new PostApproveNotification($post));

        // 承認後、承認されていないポストのみを表示
        return redirect()->route('admin.approve.page')->with('message', 'Post approved successfully!');
    }

    public function reject(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'reject_reason' => 'required|string|max:500', // 理由は必須で500文字以内
        ]);

        // ポストをデータベースから取得
        $post = Post::findOrFail($id);

        // ポストをリジェクト
        $post->approved = 2;
        $post->reject_reason = $request->reject_reason; // リジェクト理由を保存
        $post->save();

        // ポストの所有者に通知を送信
        $post->user->notify(new PostRejected($post)); // 通知の送信

        // メッセージを付けてリダイレクト
        return redirect()->route('admin.approve.page')->with('message', 'Post rejected with reason!');
    }




}

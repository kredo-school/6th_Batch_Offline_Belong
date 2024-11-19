<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Notifications\CommentNotification;

class CommentController extends Controller
{
    private $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function store(Request $request, $post_id)
    {
        // コメントのバリデーション
        $request->validate(
            [
                "comment_body{$post_id}" => 'required|max:150'
            ],
            [
                "comment_body{$post_id}.required" => 'You cannot submit an empty comment.',
                "comment_body{$post_id}.max" => 'The comment must not have more than 150 characters.',
            ]
        );

        // コメントの作成
        $commentBody = $request->input("comment_body{$post_id}");
        $comment = new Comment();
        $comment->body = $commentBody;
        $comment->user_id = Auth::id(); // ログインユーザーID
        $comment->post_id = $post_id;   // 投稿ID
        $comment->save();

        // 投稿を取得
        $post = Post::findOrFail($post_id);

        // 投稿者に通知（コメントしたユーザーが投稿者でない場合のみ通知）
        if ($post->user_id !== Auth::id()) {
            $post->user->notify(new CommentNotification($comment, $post));
        }

        // 予約ユーザーに通知（関連する予約済みユーザーを通知）
        $post->load('books.user'); // booksリレーションとそのユーザーを事前にロード
        foreach ($post->books as $booking) {
            // 予約しているユーザーに通知（自分自身には通知しない）
            if ($booking->user_id !== Auth::id()) {
                $booking->user->notify(new CommentNotification($comment, $post));
            }
        }

        return redirect()->route('posts.show', $post_id)
            ->with('success', 'Comment added successfully.');
    }



    public function destroy($comment_id)
    {
        // コメントの削除処理
        $comment = $this->comment->findOrFail($comment_id);
        $post_id = $comment->post_id; // 削除後のリダイレクト先のためにpost_idを取得

        $comment->delete(); // コメントを削除

        // 削除後、元の投稿ページにリダイレクト
        return redirect()->route('posts.show', $post_id)->with('success', 'Comment deleted successfully');
    }
}

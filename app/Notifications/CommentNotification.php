<?php

namespace App\Notifications;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CommentNotification extends Notification
{
    protected $comment;
    protected $post;

    public function __construct(Comment $comment, Post $post)
    {
        $this->comment = $comment;
        $this->post = $post;
    }

    // 通知の配信方法（データベース通知）
    public function via($notifiable)
    {
        return ['database'];
    }

    // データベース通知の内容
    public function toDatabase($notifiable)
    {
        return [
            'commenter_name' => $this->comment->user->name,  // コメントしたユーザーの名前
            'commenter_profile_url' => route('profile.show', $this->comment->user), // プロフィールへのリンク
            'post_id' => $this->post->id,
            'post_title' => $this->post->title,
            'post_url' => route('posts.show', $this->post->id), // ポストのURL
            'body' => $this->comment->body, // コメント本文
            'type' => 'comment',
        ];
    }

    // メール通知
    public function toMail($notifiable)
    {
        return (new MailMessage)
            // コメントしたユーザー名にプロファイルリンクを追加
            ->line(sprintf('%s commented on your post: ',
                '<a href="' . route('profile.show', $this->comment->user) . '" style="color: #007bff;">' .
                ($this->comment->user->name ?? 'Someone') . '</a>'
            ))
            // コメント内容にHTMLが含まれていればそのままレンダリング
            ->line($this->comment->body) // コメント内容
            // ポストタイトルにリンクを追加
            ->action('View Post', route('posts.show', $this->post->id))
            ->line('Thank you for using our application!');
    }
}

<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class PostRejected extends Notification
{
    use Queueable;

    public $post;

    public function __construct($post)
    {
        $this->post = $post;
    }

    public function via($notifiable)
    {
        return ['database', 'mail']; // データベースとメールで通知
    }

    public function toDatabase($notifiable)
    {
        return [
            'post_id' => $this->post->id,
            'title' => $this->post->title,
            'message' => 'Your post has been rejected.',
            'reason' => $this->post->reject_reason,
            'url' => route('approve.show', $this->post->id), // 投稿詳細ページのリンク
        ];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    // 件名を設定
                    ->subject('Post Rejected')

                    // リジェクトされた投稿のリンクを含むメッセージ
                    ->line('Your <a href="' . route('posts.show', $this->post->id) . '" style="color: #007bff;">post</a> has been rejected.')

                    // "View Post" アクションボタンを設定
                    ->action('View Post', url('/posts/' . $this->post->id))

                    // アプリケーションを使ってくれてありがとうメッセージ
                    ->line('Thank you for using our application!');
    }


}

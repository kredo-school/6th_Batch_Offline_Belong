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
            'message' => 'Your post has been rejected.', // タイトルをここに含めない
            'reason' => $this->post->reject_reason,
            'url' => route('approve.show', $this->post->id), // 投稿詳細ページのリンク
        ];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Post Rejected')
                    ->line('Your post has been rejected.')
                    ->action('View Post', url('/posts/' . $this->post->id))
                    ->line('Thank you for using our application!');
    }
}

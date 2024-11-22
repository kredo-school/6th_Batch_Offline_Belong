<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;

class PostApproveNotification extends Notification
{
    use Queueable;

    protected $post;

    // コンストラクタで投稿を受け取る
    public function __construct($post)
    {
        $this->post = $post;
    }

    /**
     * 通知を送るチャネル（via）を指定する
     */
    public function via($notifiable)
    {
        // 通知の送信方法を指定（ここではデータベースとメール）
        return ['database', 'mail'];
    }

    /**
     * 通知をデータベースに保存するメソッド
     */
    public function toDatabase($notifiable)
    {
        return [
            'post_id' => $this->post->id,
            'post_title' => $this->post->title,
            'post_url' => route('posts.show', $this->post->id), // 投稿を表示するURL
            'type' => 'approve', // 通知のタイプ
        ];
    }

    /**
     * 通知をメールとして送信する場合の設定
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Your Post has been Approved') // メールの件名
            ->line('Your post "' . $this->post->title . '" has been approved.') // メール本文
            ->action('View Post', route('posts.show', $this->post->id)) // 投稿を確認するリンク
            ->line('Thank you for using our platform!');
    }

}

<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;

class ReviewNotification extends Notification
{
    use Queueable;

    protected $review;

    /**
     * Create a new notification instance.
     *
     * @param  \App\Models\Review  $review
     * @return void
     */
    public function __construct($review)
    {
        $this->review = $review;
    }

    /**
     * 通知をデータベースに送信
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'type' => 'review',
            'reviewer_name' => $this->review->user->name, // レビューしたユーザー名
            'post_title' => $this->review->post->title, // 投稿タイトル
            'review_url' => route('posts.show', $this->review->post->id), // 投稿詳細ページのURL
            'rating' => $this->review->rating, // 評価
            'message' => 'Your post has received a new review!' // 通知メッセージ
        ];
    }

    /**
     * 通知をメールで送信
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('New Review on Your Post')
                    ->line('Your post "' . $this->review->post->title . '" has received a new review!')
                    ->line('Rating: ' . $this->review->rating . ' stars')
                    ->action('View Post', route('posts.show', $this->review->post->id))
                    ->line('Thank you for using our application!');
    }

    
}

<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Review;
use App\Models\User;
use App\Models\Post;
use Illuminate\Notifications\Messages\DatabaseMessage;

class ReviewNotification extends Notification
{
    use Queueable;

    protected $review;
    protected $post;

    /**
     * Create a new notification instance.
     *
     * @param  \App\Models\Review  $review
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function __construct(Review $review, Post $post)
    {
        $this->review = $review;
        $this->post = $post;
    }

    /**
     * 通知を送信するチャネルを指定
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // データベースとメールの両方で通知を送信
        return ['database'];
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
            'reviewer_profile_url' => route('profile.show', $this->review->user), // プロフィールへのリンク
            'post_title' => $this->post->title,          // 投稿タイトル
            'review_url' => route('posts.show', $this->post->id), // 投稿詳細ページのURL
            'rating' => $this->review->rating,          // 評価
            'comment' => $this->review->comment,        // コメント
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
                    ->line('Your post "' . $this->post->title . '" has received a new review!')
                    ->line('Rating: ' . $this->review->rating . ' stars')
                    ->line('Comment: ' . $this->review->comment)
                    ->action('View Post', route('posts.show', $this->post->id))
                    ->line('Thank you for using our application!');
    }
}

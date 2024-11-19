<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingNotification extends Notification
{
    use Queueable;

    protected $post;
    protected $booker;

    /**
     * Create a new notification instance.
     */
    public function __construct($post, $booker)
    {
        $this->post = $post;
        $this->booker = $booker;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['database']; // データベース通知
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable)
    {
        return [
            'message' =>
                // 参加者の名前へのリンク 
               'hi <a href ="#">Sample</a>',
            'post_id' => $this->post->id,
            'post_title' => $this->post->title,
            'post_url' => route('posts.show', $this->post->id), // 予約したポストのURL
        ];
    }

    /**
     * Get the email notification's content.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            // 参加者の名前へのリンク
            ->line(sprintf('%s has joined your event: ',
                // 名前をリンク化
                '<a href="' . route('profile.show', $this->booker->id) . '" style="color: #007bff;">' .
                ($this->booker->name ?? 'Someone') . '</a>'
            ))
            // イベントタイトルへのリンク
            ->line('Event: ' .
                '<a href="' . route('posts.show', $this->post->id) . '" style="color: #007bff;">' .
                $this->post->title .
                '</a>'
            )
            ->line('Thank you for using our application!');
    }
}

<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Post;
use App\Models\User;

class BookingNotification extends Notification
{
    use Queueable;

    protected $post;
    protected $booker;

    /**
     * Create a new notification instance.
     *
     * @param Post $post
     * @param User $booker
     */
    public function __construct(Post $post, User $booker)
    {
        $this->post = $post;
        $this->booker = $booker;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail']; // データベース通知とメール通知
    }

    /**
     * Get the array representation of the notification for database storage.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'booker_name' => $this->booker->name, // 参加者の名前
            'booker_profile_url' => route('profile.show', ['id' => $this->booker->id]),
            'post_id' => $this->post->id, // イベントのID
            'post_title' => $this->post->title, // イベントのタイトル
            'post_url' => route('posts.show', $this->post->id), // イベントのURL
            'type' => 'booking', // 通知タイプ
        ];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Booking for Your Event')
            ->line(sprintf(
                '%s has joined your event:',
                '<a href="' . route('profile.show', $this->booker->id) . '" style="color: #007bff;">' .
                ($this->booker->name ?? 'Someone') . '</a>'
            ))
            ->line(sprintf(
                'Event: <a href="%s" style="color: #007bff;">%s</a>',
                route('posts.show', $this->post->id),
                $this->post->title
            ))
            ->line('Thank you for using our application!');
    }
}

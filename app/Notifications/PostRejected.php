<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Post;

class PostRejected extends Notification
{
    use Queueable;

    protected $post;

    /**
     * Constructor
     *
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Get the notification's delivery channels
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail']; // Using database and mail notifications
    }

    /**
     * Prepare database notification data
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'post_id' => $this->post->id,
            'post_title' => $this->post->title, // Post title
            'reason' => $this->post->reject_reason, // Rejection reason
            'post_url' => route('approve.show', $this->post->id), // Post URL
            'type' => 'rejection', // Notification type
        ];
    }

    /**
     * Prepare the email notification
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Post Rejected') // Subject
            ->line(sprintf(
                'Your post "<a href="%s" style="color: #007bff;">%s</a>" has been rejected.',
                route('approve.show', $this->post->id),
                $this->post->title
            )) // Message
            ->line(sprintf(
                'Reason: %s',
                $this->post->reject_reason ?? 'No reason provided'
            )) // Rejection reason
            ->action('View Details', route('posts.show', $this->post->id)) // View details link
            ->line('Thank you for using our application!');
    }
}

<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AdminNotification extends Notification
{
    protected $message;

    // コンストラクタでメッセージを受け取る
    public function __construct($message)
    {
        $this->message = $message;
    }

    // 通知を送るチャンネルを指定
    public function via($notifiable)
    {
        return ['database']; // データベースを使用して通知を送信
    }

    // データベース通知の内容を定義
    public function toDatabase($notifiable)
    {
        return new DatabaseMessage([
            'message' => $this->message,
        ]);
    }
}


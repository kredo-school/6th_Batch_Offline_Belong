<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserNotification extends Notification
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
        return ['database']; // データベースチャネルを使用
    }

    // データベース通知の内容を定義
    public function toDatabase($notifiable)
    {
        return [
            'message' => $this->message, // 通知メッセージを保存
        ];
    }
}

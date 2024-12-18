<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    const ADMIN_ROLE_ID = 1; // administrator
    const USER_ROLE_ID = 2; //the regular user

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function posts()
    {
        return $this->hasMany(Post::class)->latest();
    }


    public function postCount() {
        return $this->posts()->where('approved', true)->count();
    }

    public function payments()
    {
        return $this->hasOne(Payment::class); // ユーザーと支払いのリレーションを定義
    }

    // 通知を取得するメソッド（例：UserController や NotificationController）
    public function getUnreadNotificationsCount()
    {
        // ログインユーザーの未読通知数を取得
        $unreadCount = auth()->user()->unreadNotifications->count();
        return $unreadCount;
    }



}

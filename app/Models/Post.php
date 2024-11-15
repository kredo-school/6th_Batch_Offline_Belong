<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'date', 'reservation_due_date', 'place', 'planned_number_of_people', 
        'participation_fee', 'description', 'image', 'user_id', 'approved',
    ];

    // statusの初期値を設定
    protected $attributes = [
        'status' => 'pending',  // 投稿はデフォルトで保留状態
    ];


    // 画像パスのアクセサ
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function isBooked()
    {
        // 現在のユーザーがこの投稿をすでにブックしているかを確認
        return $this->books()->where('user_id', auth()->id())->exists();
    }

    public function isBookedBy($user)
    {
        // 指定されたユーザーがこの投稿をすでにブックしているかを確認
        return $this->books->contains('user_id', $user->id);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_post');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function categoryPost()
    {
        return $this->hasMany(CategoryPost::class);
    }


}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'title',
        'date',
        'reservation_due_date',
        'place',
        'planned_number_of_people',
        'participation_fee',
        'description',
        'image',
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
}


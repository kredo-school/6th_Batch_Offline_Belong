<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function categoryPost()
    {
        return $this->hasMany(CategoryPost::class); // リレーションを定義
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'category_post');
    }
}
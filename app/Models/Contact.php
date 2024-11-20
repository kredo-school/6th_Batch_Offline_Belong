<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // HasFactory トレイトをインポート
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory; // ここでトレイトを使用

    protected $fillable = [
        'name', 'email', 'message',
    ];
}


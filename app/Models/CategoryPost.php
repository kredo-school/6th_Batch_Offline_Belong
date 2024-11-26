<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    use HasFactory;

    protected $table = 'category_post';

    protected $fillable = ['category_id','post_id'];

    public $timestamps = false;

    public function category()
    {
        return $this->BelongsTo(Category::class);
    }

    public function posts()
    {
        return $this->belongsTO(Post::class, 'post_id');
    }

    

}

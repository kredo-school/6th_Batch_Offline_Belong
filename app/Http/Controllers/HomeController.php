<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    private $post;

    public function __construct(Post $post)
    {
        $this->post = $post; // Postモデルをコンストラクトで利用
    }
    
    public function index()
    {
        $posts = Post::where('approved', true)
                     ->orderBy('created_at', 'desc')
                     ->take(6)
                     ->get();
    
        return view('home', compact('posts'));
    }
}

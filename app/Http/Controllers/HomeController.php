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

    public function show(){
        return view('welcome');
    }
    
    public function index()
    {
        $posts = Post::where('approved', true)
                     ->orderBy('created_at', 'desc')
                     ->take(6)
                     ->get();
    
        return view('home')->with("posts", $posts)->with("big_posts",$this->big());
    }

    public function big()
{
    $posts = Post::where('planned_number_of_people', '>=', 20)
                 ->where('approved', true)
                 ->get();

    // if ($posts->isEmpty()) {
    //     return view('big-events')->with('message', '該当するイベント投稿はありません。');
    // }

    return $posts;
}

    
}

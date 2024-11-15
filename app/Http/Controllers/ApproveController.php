<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class ApproveController extends Controller
{
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.approveshow', compact('post'));
    }

}

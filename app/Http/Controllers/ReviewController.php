<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function create(Post $post)
    {
        return view('posts.reviews.create', compact('post'));
    }

    public function store(Request $request, Post $post)
    {
        // $request->validate([
        //     'rating' => 'required|integer|min:1|max:5',
        //     'comment' => 'nullable|string|max:255',
        // ]);

        
    
        $post->reviews()->create([
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);
    
        return redirect()->route('posts.show', $post)->with('success', 'Review submitted successfully!');
    }
    

    public function index(Post $post)
    {
        $reviews = $post->reviews()->with('user')->latest()->get();
        return view('posts.reviews.index', compact('post', 'reviews'));
    }
}


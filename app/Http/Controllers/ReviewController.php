<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Review;
use App\Models\User;
use App\Notifications\ReviewNotification;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    private $post;
    public function create(Post $post)
    {
        return view('posts.reviews.create', compact('post'));
    }

    public function store(Request $request, Post $post)
    {

        $post->reviews()->create([
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        $post->user->notify(new ReviewNotification($post->reviews()->latest()->first()));

        return redirect()->route('posts.show', $post)->with('success', 'Review submitted successfully!');
    }


    public function index(Post $post)
    {
        $reviews = $post->reviews()->with('user')->latest()->get();
        return view('posts.reviews.index', compact('post', 'reviews'));
    }
}


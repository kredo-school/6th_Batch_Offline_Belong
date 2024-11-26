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

        // バリデーション
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        // レビューを作成し、その結果を $review に代入
        $review = $post->reviews()->create([
            'user_id' => auth()->id(),
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        // 投稿の主催者に通知を送信
        $post->user->notify(new ReviewNotification($review, $post));

        // 成功メッセージとともにリダイレクト
        return redirect()->route('posts.show', $post)
            ->with('success', 'Review submitted successfully!');
    }


    public function index(Post $post)
    {
        $reviews = $post->reviews()->with('user')->latest()->get();
        return view('posts.reviews.index', compact('post', 'reviews'));
    }
}


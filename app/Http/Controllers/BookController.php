<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Book;
use Illuminate\Http\Request;
use App\Notifications\BookingNotification;

class BookController extends Controller
{
    public function show(Post $post)
    {
        return view('posts.booking', compact('post'));
    }

    public function store(Request $request, $postId)
    {
        $post = Post::findOrFail($postId);
        $user = auth()->user(); // 現在のユーザー

        // すでにブックしている場合はエラーを返す
        if ($post->books()->where('user_id', $user->id)->exists()) {
            return redirect()->back()->with('error', 'You have already booked this event.');
        }

        // ブック処理
        $post->books()->create(['user_id' => $user->id]);

        // 主催者に通知を送信
        $post->user->notify(new BookingNotification($post, $user));

        // すでにブックしている他のユーザーに通知を送信
        $bookedUsers = $post->books()->with('user')->get()->pluck('user');
        foreach ($bookedUsers as $bookedUser) {
            if ($bookedUser->id !== $user->id) { // 自分以外
                $bookedUser->notify(new BookingNotification($post, $user));
            }
        }

        return redirect()->route('posts.show', $postId)->with('success', 'You have successfully booked this event.');
    }

    public function index()
    {
        // Fetch booked posts where the date is in the future
        $bookedPosts = Book::where('user_id', auth()->id())
            ->whereHas('post', function($query) {
                $query->where('date', '>', now());
            })
            ->with('post.user') // Eager load the user associated with the post
            ->get();

        return view('posts.booked', compact('bookedPosts')); // Pass bookedPosts to the view
    }

    public function attendedPosts()
    {
        // Get the posts that the authenticated user has attended
        $attendedPosts = Book::where('user_id', auth()->id())
            ->with('post') // Eager load the related posts
            ->get()
            ->pluck('post') // Extract the post from the Book relationship
            ->filter(function ($post) {
                return $post && $post->date < now(); // Filter to only include past posts
            });

        return view('posts.attended', compact('attendedPosts'));
    }

    public function destroy($postId)
    {
        // Use the postId to find the booking
        $booking = Book::where('post_id', $postId)
                        ->where('user_id', auth()->id())
                        ->first();

        if ($booking) {
            $booking->delete(); // Delete the booking
            return redirect()->back()->with('success', 'Booking cancelled successfully.');
        }

        return redirect()->back()->with('error', 'You do not have a booking to cancel.');
    }
}

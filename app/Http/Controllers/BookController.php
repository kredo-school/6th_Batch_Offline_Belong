<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function show(Post $post)
    {
        return view('posts.booking', compact('post'));
    }

    public function store(Request $request, Post $post)
    {
        $existingBooking = Book::where('user_id', $request->user()->id)
            ->where('post_id', $post->id)
            ->first();

        if ($existingBooking) {
            return redirect()->route('posts.show', $post->id)->with('error', 'You have already joined this event.');
        }

        Book::create([
            'user_id' => $request->user()->id,
            'post_id' => $post->id,
        ]);

        return redirect()->route('posts.show', $post->id)->with('success', 'Successfully joined the event!');
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

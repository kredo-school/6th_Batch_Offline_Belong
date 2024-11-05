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
        $bookedPosts = Book::where('user_id', auth()->id())
                            ->whereHas('post', function($query) {
                                $query->where('date', '>', now());
                            })
                            ->with('post.user')
                            ->get();

        return view('posts.booked', compact('bookedPosts'));
    }

    public function destroy(Post $post)
    {
        $booking = $post->books()->where('user_id', auth()->id())->first();

        if ($booking) {
            $booking->delete();
            return redirect()->route('posts.booked')->with('success', 'Booking cancelled successfully.');
        }

        return redirect()->route('posts.booked')->with('error', 'You do not have a booking to cancel.');
    }
}

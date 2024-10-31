<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function show(Post $post)
    {
        // 必要なデータを取得し、booking.blade.phpを返します
        return view('posts.booking', compact('post'));
    }

    public function store(Request $request, Post $post)
    {
        // 参加者情報を保存するための条件
        $existingBooking = Book::where('user_id', $request->user()->id)
            ->where('post_id', $post->id)
            ->first();

        // 既に予約がある場合の処理
        if ($existingBooking) {
            return redirect()->route('posts.show', $post->id)->with('error', 'You have already joined this event.');
        }

        // ブックを保存
        Book::create([
            'user_id' => $request->user()->id, // ログインユーザーのIDを使用
            'post_id' => $post->id,
        ]);

        // リダイレクト
        return redirect()->route('posts.show', $post->id)->with('success', 'Successfully joined the event!');
    }

    public function destroy(Post $post)
    {
        // 予約キャンセルのロジックをここに実装
        $booking = $post->books()->where('user_id', auth()->id())->first();
        
        if ($booking) {
            $booking->delete(); // 予約を削除
            return redirect()->back()->with('success', 'Booking cancelled successfully.');
        }

        return redirect()->back()->with('error', 'You do not have a booking to cancel.');
    }
}


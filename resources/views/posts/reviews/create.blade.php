@extends('layouts.app')

@section('content')
<style>
    .rating {
        direction: rtl; /* 右から左に表示 */
    }

    .rating input {
        display: none; /* ラジオボタンを隠す */
    }

    .rating label {
        font-size: 2rem; /* 星のサイズを大きくする */
        color: lightgray; /* デフォルトの星の色 */
        cursor: pointer; /* マウスカーソルをポインターに */
    }

    .rating input:checked ~ label {
        color: red; /* 選択された星の色 */
    }

    .rating label:hover,
    .rating label:hover ~ label {
        color: gold; /* ホバーしたときの星の色 */
    }
</style>
<div class="container mt-5">
    <h2>Review for {{ $post->title }}</h2>
    <form method="POST" action="{{ route('reviews.store', $post) }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Rating</label>
            <div class="rating text-start">
                @for ($i = 5; $i >= 1; $i--)
                {{$i}}
                    <input type="radio" name="rating" value="{{ $i }}" id="rating_{{ $i }}" required>
                    <label for="rating_{{ $i }}" class="star">&#9733;</label> <!-- Unicode for filled star -->
                @endfor
            </div>
            @error('rating')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Comment</label>
            <textarea class="form-control" name="comment" rows="3"></textarea>
            @error('comment')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mb-3">Submit Review</button>
    </form>
</div>
@endsection

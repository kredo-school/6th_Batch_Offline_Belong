@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <h2>Reviews for {{ $post->title }}</h2>

    @foreach($reviews as $review)
        <div class="card mb-3 shadow-sm">
            <div class="card-body d-flex align-items-start">
                <!-- ユーザーのアバター -->
                <a href="#">
                    @if($review->user->avatar)
                        <img src="{{ $review->user->avatar }}" alt="{{ $review->user->name }}" class="rounded-circle avatar" style="width: 50px; height: 50px; margin-right: 15px;">
                    @else
                        <i class="fa-solid fa-circle-user text-secondary icon-sm" style="font-size: 50px; margin-right: 15px;"></i>
                    @endif
                </a>

                <div class="ms-3">
                    <h5 class="card-title">{{ $review->user->name }}</h5>
                    <div class="mb-2">
                        <!-- 星の表示 -->
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $review->rating)
                                <span class="text-warning">★</span> <!-- 塗りつぶされた星 -->
                            @else
                                <span class="text-muted">☆</span> <!-- 空の星 -->
                            @endif
                        @endfor
                    </div>
                    <p class="card-text">{{ $review->comment }}</p>
                    <p class="card-text"><small class="text-muted">{{ $review->created_at->diffForHumans() }}</small></p>
                </div>
            </div>
        </div>
    @endforeach

    @if ($reviews->isEmpty())
        <p class="text-center">No reviews yet.</p>
    @endif
</div>
@endsection

@extends('layouts.app')

@section('content')
<style>
    .rounded-image {
        width: 50px; /* 幅を指定 */
        height: 50px; /* 高さを指定 */
        border-radius: 50%; /* 丸くする */
        object-fit: cover; /* 画像が枠に収まるように調整 */
        font-size: 2rem; /* アイコンのサイズを調整 */
    }
</style>
<div class="container mt-3">
    <h2>Reviews for {{ $post->title }}</h2>

    @foreach($reviews as $review)
        <div class="card mb-3 shadow-sm">
            <div class="card-body d-flex align-items-start">
                <!-- ユーザーのアバター -->
                <a href="{{ route('profile.show', $post->user->id) }}" class="text-decoration-none">
                    @if($post->user->profile_image)
                        <img src="{{ $post->user->profile_image }}" alt="{{ $post->user->name }}" class="rounded-image">
                    @else
                        <!-- デフォルト画像を表示 -->
                        <i class="fa-solid fa-circle-user d-block text-center text-secondary" style="font-size: 3rem;"></i>
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

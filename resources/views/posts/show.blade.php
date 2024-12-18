@extends('layouts.app')

@section('title', 'Show Post')

@section('content')
<style>
    .card-body {
        position: relative;
    }

    .card-body img {
        margin: 0; /* 画像周りの隙間を削除 */
        padding: 0; /* 画像周りの余白を削除 */
        display: block; /* インライン要素の隙間を取り除く */
        width: 100%; /* 画像を親要素にフィットさせる */
        height: auto; /* 高さを自動調整 */
    }

    .rounded-image {
        width: 50px; /* 幅を指定 */
        height: 50px; /* 高さを指定 */
        border-radius: 50%; /* 丸くする */
        object-fit: cover; /* 画像が枠に収まるように調整 */
        font-size: 2rem; /* アイコンのサイズを調整 */
    }

    /* ユーザーネームのサイズとスタイルを調整 */
    .user-name {
        font-size: 1.5rem; /* 少し大きく */
        font-weight: bold; /* 太字に */
        color: #333; /* ダークグレーで見やすく */
    }

    .icon-count {
        font-size: 1.25rem;
        margin-left: 5px;
    }

    .icon-lg {
        font-size: 1.5rem;
    }

    .comment-meta {
        font-size: 0.9rem;
        color: #6c757d;
    }
</style>

<div class="row border shadow mt-5 mb-5 col-6 mx-auto">
    <div class="col p-0 bg-white">
        <div class="card border-0">
            <div class="card-header bg-white py-3">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <a href="{{ route('profile.show', $post->user->id) }}" class="text-decoration-none">
                            @if($post->user->profile_image)
                                <img src="{{ $post->user->profile_image }}" alt="{{ $post->user->name }}" class="rounded-image">
                            @else
                                <!-- デフォルト画像を表示 -->
                                <i class="fa-solid fa-circle-user d-block text-center text-secondary" style="font-size: 3rem;"></i>
                            @endif
                        </a>
                    </div>

                    <div class="col ps-0">
                        <a href="#" class="text-decoration-none text-dark fw-bold">{{ $post->user->name }}</a>
                    </div>

                    <div class="col-auto">
                        @if(Auth::user()->id === $post->user_id)
                        <button class="btn btn-sm shadow-none" data-bs-toggle="dropdown">
                            <i class="fa-solid fa-ellipsis"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a href="{{ route('posts.edit', $post->id) }}" class="dropdown-item">
                                <i class="fa-regular fa-pen-to-square"></i>Edit
                            </a>
                            <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#delete-post-{{ $post->id }}">
                                <i class="fa-regular fa-trash-can"></i>Delete
                            </button>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="card-body">
                @if ($post->image)
                <img src="{{ $post->image }}" alt="Post ID {{ $post->id }}" class="" style="width: 100%;">
                @endif

                <div class="mt-3">
                    <h4 class="fw-bold">Title: {{ $post->title }}</h4>
                    <div class="col text-start mb-3">
                        @if($post->categories->isNotEmpty())
                        @foreach($post->categories as $category)
                        <div class="badge bg-secondary bg-opacity-50">
                            {{ $category->name }}
                        </div>
                        @endforeach
                        @else
                        <div class="badge bg-dark text-wrap">Uncategorized</div>
                        @endif
                    </div>
                    <strong>Date:</strong> {{ date('M d, Y', strtotime($post->date)) }}<br>
                    <strong>Reservation Due Date:</strong> {{ date('M d, Y', strtotime($post->reservation_due_date)) }}<br>
                    <strong>Place:</strong> {{ $post->place }}<br>
                    <strong>Participation Fee:</strong> {{ $post->participation_fee }}<br>
                    <strong>Planned Number of People:</strong> {{ $post->planned_number_of_people }}<br>
                    <strong>Description:</strong> {{ $post->description }}<br>
                    <p class="text-uppercase text-muted xsmall">{{ date('M d, Y', strtotime($post->created_at)) }}</p>
                </div>

                <div class="text-end">
                    <a href="#" class="btn btn-sm shadow-none p-0" data-bs-toggle="modal" data-bs-target="#usersModal{{ $post->id }}">
                        <i class="fa-solid fa-user icon-lg"></i>
                        <span class="icon-count">{{ $post->books->count() }}</span>
                    </a>

                    {{-- 予約可能期限のチェック --}}
                    @if($post->reservation_due_date && now()->lessThan($post->reservation_due_date))
                        {{-- 既に予約済みの場合 --}}
                        @if($post->isBooked())
                            <span class="btn btn-sm shadow-none p-0 text-muted" title="Already Booked">
                                <i class="fa-solid fa-heart text-danger icon-lg"></i>
                            </span>
                        @else
                            {{-- 予約可能な場合のみ予約ボタンを表示 --}}
                            <a href="{{ route('bookings.show', $post->id) }}" class="btn btn-sm p-0" title="Book this Post">
                                <i class="fa-regular fa-heart text-danger icon-lg"></i>
                            </a>
                        @endif
                    @else
                        {{-- 予約期限が過ぎた場合のメッセージ --}}
                        <span class="btn btn-sm shadow-none p-0 text-muted" title="Reservation period has ended">
                            <i class="fa-regular fa-heart text-secondary icon-lg"></i>
                        </span>
                    @endif
                </div>


                @include('posts.contents.modals.users', ['post' => $post])

                <hr>

                <form action="{{ route('comment.store', $post->id) }}" method="post">
                    @csrf
                    <div class="input-group">
                        <textarea name="comment_body{{ $post->id }}" rows="1" class="form-control form-control-sm" placeholder="Add a comment..." required>{{ old('comment_body' . $post->id) }}</textarea>
                        <button class="btn btn-outline-secondary btn-sm">Post</button>
                    </div>
                    @error('comment_body_' . $post->id)
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </form>

                @if($post->comments && $post->comments->isNotEmpty())
                <hr>
                <ul class="list-group">
                    @foreach($post->comments as $comment)
                    <li class="list-group-item border-0 p-2">
                        <div class="d-flex align-items-start">
                            <!-- ユーザープロフィールアイコン -->
                            <a href="{{ route('profile.show', $comment->user->id) }}" class="me-2" style="text-decoration: none">
                                @if ($comment->user->profile_image)
                                    <img src="{{ $comment->user->profile_image }}" alt="Profile Image" class="rounded-circle" style="width: 32px; height: 32px; object-fit: cover;">
                                @else
                                    <i class="fa-solid fa-circle-user text-secondary" style="font-size: 32px;"></i>
                                @endif
                            </a>

                            <!-- ユーザーネームとコメント -->
                            <div>
                                <a href="{{ route('profile.show', $comment->user->id) }}" class="text-decoration-none text-dark fw-bold me-2">{{ $comment->user->name }}</a>
                                <span class="text-muted small">{{ $comment->body }}</span>

                                <!-- 投稿日時 -->
                                <div class="text-muted small mt-1">
                                    {{ date('M d, Y', strtotime($comment->created_at)) }}
                                </div>
                            </div>
                        </div>

                        <!-- アクションボタン -->
                        @if(Auth::user()->id === $comment->user->id)
                            <div class="text-end mt-1">
                                <form action="{{ route('comment.destroy', $comment->id) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="border-0 bg-transparent text-danger p-0 small">
                                        <i class="fa-sharp fa-solid fa-trash text-danger"></i>
                                    </button>
                                </form>
                            </div>
                        @endif
                    </li>
                    @endforeach
                </ul>
                @endif

                <hr>

                <div class="text-center mt-2">
                    @if(now() > \Carbon\Carbon::parse($post->date))
                        @if($post->isBookedBy(Auth::user()))
                            <a href="{{ route('reviews.create', $post) }}" class="btn btn-primary btn-sm">Write Review</a>
                        @else
                            <button class="btn btn-secondary btn-sm" disabled>Review (Unavailable)</button>
                        @endif
                    @else
                        <button class="btn btn-secondary btn-sm" disabled>Review (Unavailable)</button>
                    @endif
                    <a href="{{ route('reviews.index', $post) }}" class="btn btn-danger btn-sm">View Reviews</a>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<br>

@include('posts.contents.modals.delete', ['post' => $post])
@endsection

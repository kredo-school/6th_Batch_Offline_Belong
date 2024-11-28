@extends('layouts.app')

@section('title', 'tutorial Posts')

@section('content')
<style>
    .card-body {
        position: relative;
    }
    .post-image {
        width: 100%;
        height: 300px;
        object-fit: cover;
    }
    .rounded-image {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
        font-size: 2rem;
    }
    .user-name {
        font-size: 2.0rem;
        font-weight: bold;
    }
    .post-card {
        margin-bottom: 20px;
        border: 2px solid #ddd; /* 枠線の追加 */
        border-radius: 8px; /* 枠線の角を丸める */
        padding: 15px; /* 内側の余白 */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* 軽い影をつけて立体感を出す */
        transition: transform 0.3s ease-in-out; /* ホバー時のアニメーション */
    }
    .post-card:hover {
        transform: translateY(-5px); /* ホバー時に少し持ち上げる */
    }
</style>

<div class="container mt-5">
    <div class="row">
        @foreach ($all_posts as $post)
            <div class="col-md-6">
                <div class="card post-card border-0">
                    <div class="card-header bg-white py-3">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                @if($post->user)
                                    <a href="{{ route('profile.show', $post->user->id) }}" class="text-decoration-none">
                                        @if($post->user->profile_image)
                                            <img src="{{ $post->user->profile_image }}" alt="{{ $post->user->name }}" class="rounded-image">
                                        @else
                                            <i class="fa-solid fa-circle-user d-block text-center text-secondary" style="font-size: 3rem;"></i>
                                        @endif
                                    </a>
                                @else
                                    <i class="fa-solid fa-circle-user d-block text-center text-secondary" style="font-size: 3rem;"></i>
                                    <span class="text-muted">Unknown User</span>
                                @endif
                            </div>
                            <div class="col ps-0">
                                @if($post->user)
                                    <a href="#" class="text-decoration-none text-dark">{{ $post->user->name }}</a>
                                @else
                                    <span class="text-muted">Unknown User</span>
                                @endif
                            </div>

                            @if(Auth::check() && Auth::user()->id === $post->user_id)
                                <div class="col-auto">
                                    <button class="btn btn-sm shadow-none" data-bs-toggle="dropdown">
                                        <i class="fa-solid fa-ellipsis"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="{{ route('posts.edit', $post->id) }}" class="dropdown-item">
                                            <i class="fa-regular fa-pen-to-square"></i> Edit
                                        </a>
                                        <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#delete-post-{{ $post->id }}">
                                            <i class="fa-regular fa-trash-can"></i> Delete
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if ($post->image)
                        <a href="{{ route('posts.show', $post->id) }}">
                            <img src="{{ $post->image }}" alt="Post ID {{ $post->id }}" class="post-image mb-3">
                        </a>
                    @endif

                    <div class="mt-3">
                        <h4 class="fw-bold">Title: {{ $post->title }}</h4>
                        <div class="col text-start">
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
                        <strong>Description:</strong> {{ $post->description }}
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

                    <!-- Include modal for viewing participating users -->
                    @include('posts.contents.modals.users', ['post' => $post])

                    <hr>

                    <form action="{{ route('comment.store', $post->id) }}" method="post">
                        @csrf
                        <div class="input-group">
                            <textarea name="comment_body{{ $post->id }}" rows="1" class="form-control form-control-sm" placeholder="Add a comment..." required>{{ old('comment_body' . $post->id) }}</textarea>
                            <button class="btn btn-outline-secondary btn-sm">Post</button>
                        </div>
                        @error('comment_body' . $post->id)
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
                                @if(Auth::check() && Auth::user()->id === $comment->user_id)
                                    <div class="dropdown">
                                        <button class="btn btn-sm shadow-none" data-bs-toggle="dropdown">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a href="{{ route('comment.edit', $comment->id) }}" class="dropdown-item">
                                                <i class="fa-regular fa-pen-to-square"></i> Edit
                                            </a>
                                            <form action="{{ route('comment.destroy', $comment->id) }}" method="POST" class="dropdown-item">
                                                @csrf
                                                @method('DELETE')
                                                <i class="fa-regular fa-trash-can"></i> Delete
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
@endsection

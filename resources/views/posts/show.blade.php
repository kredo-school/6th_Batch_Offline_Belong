@extends('layouts.app')

@section('title', 'Show Post')

@section('content')
    <style>
        .card-body {
            position: relative;
        }
        .avatar {
            width: 100px;
            height: 50px;
        }
        .user-name {
            font-size: 2.0rem;
            font-weight: bold;
        }
        .icon-count {
            font-size: 1.5rem;
            margin-left: 5px;
        }
        .icon-lg {
            font-size: 1.5rem;
        }
        .comment-meta {
            font-size: 0.8rem;
            color: #6c757d;
        }
    </style>

    <div class="row border shadow mt-5 mb-5 col-6 mx-auto">
        <div class="col p-0 bg-white">
            <div class="card border-0">
                <div class="card-header bg-white py-3">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <a href="#">
                                @if($post->user->avatar)
                                    <img src="{{ $post->user->avatar }}" alt="{{ $post->user->name }}" class="rounded-circle avatar w-100">
                                @else
                                    <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                @endif
                            </a>
                        </div>
                        <div class="col ps-0">
                            <a href="#" class="text-decoration-none text-dark">{{ $post->user->name }}</a>
                        </div>

                        <div class="col-auto">
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
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if ($post->image)
                        <img src="{{ $post->image }}" alt="Post ID {{ $post->id }}" class="w-100 mb-3">
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

                        @if($post->isBooked())
                            <form action="{{ route('bookings.destroy', $post->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm shadow-none p-0" title="Cancel Booking">
                                    <i class="fa-solid fa-heart text-danger icon-lg"></i>
                                </button>
                            </form>
                        @else
                            <a href="{{ route('bookings.show', $post->id) }}" class="btn btn-sm p-0" title="Book this Post">
                                <i class="fa-regular fa-heart text-danger icon-lg"></i>
                            </a>
                        @endif
                    </div>

                    <!-- 参加しているユーザーのモーダルをインクルード -->
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
                                <li class="list-group-item border-0 p-0 mb-2">
                                    <a href="#" class="text-decoration-none text-dark fw-bold">{{ $comment->user->name }}</a>
                                    <p class="d-inline fw-light">{{ $comment->body }}</p>

                                    <div class="d-flex justify-content-between mt-1">
                                        <span class="text-muted small">{{ date('M d, Y', strtotime($comment->created_at)) }}</span>

                                        @if(Auth::user()->id === $comment->user->id)
                                            <form action="{{ route('comment.destroy', $comment->id) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="border-0 bg-transparent text-danger p-0 small">Delete</button>
                                            </form>
                                        @endif
                                    </div>

                                    <hr>

                                    <!-- 各コメントの下にレビューボタンを追加 -->
                                    <div class="text-center mt-2">
                                        @if(now() > \Carbon\Carbon::parse($post->date)) <!-- イベントの日付を基準にする -->
                                            <a href="{{ route('reviews.create', $post) }}" class="btn btn-primary btn-sm">Write Review</a>
                                        @else
                                            <button class="btn btn-secondary btn-sm" disabled>Review (Unavailable)</button>
                                        @endif
                                        <a href="{{ route('reviews.index', $post) }}" class="btn btn-info btn-sm">View Reviews</a>
                                    </div>


                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- 投稿削除モーダルをインクルード -->
    @include('posts.contents.modals.delete', ['post' => $post])
@endsection

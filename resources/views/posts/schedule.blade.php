@extends('layouts.app')

@section('title', 'Schedule Posts')

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
    .post-card {
        margin-bottom: 20px;
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
                                <a href="#">
                                    @if($post->user->avatar)
                                        <img src="{{ $post->user->avatar }}" alt="{{ $post->user->name }}" class="rounded-circle avatar">
                                    @else
                                        <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                    @endif
                                </a>
                            </div>
                            <div class="col ps-0">
                                <a href="#" class="text-decoration-none text-dark">{{ $post->user->name }}</a>
                            </div>

                            @if (Auth::user()->id === $post->user_id) <!-- 投稿者のみドロップダウンメニューを表示 -->
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
                            <img src="{{ $post->image }}" alt="Post ID {{ $post->id }}" class="w-100 mb-3">
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

                        @if($post->isBooked())
                            <span class="btn btn-sm shadow-none p-0 text-muted" title="Already Booked">
                                <i class="fa-solid fa-heart text-danger icon-lg"></i>
                            </span>
                        @else
                            <a href="{{ route('bookings.show', $post->id) }}" class="btn btn-sm p-0" title="Book this Post">
                                <i class="fa-regular fa-heart text-danger icon-lg"></i>
                            </a>
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
                                <li class="list-group-item border-0 p-0 mb-2">
                                    <a href="#" class="text-decoration-none text-dark fw-bold">{{ $comment->user->name }}</a>
                                    <p class="d-inline fw-light">{{ $comment->body }}</p>

                                    <div class="d-flex justify-content-between mt-1">
                                        <span class="text-muted small">{{ date('M d, Y', strtotime($comment->created_at)) }}</span>

                                        @if(Auth::user()->id === $comment->user_id) <!-- Check if the comment's author is the logged-in user -->
                                            <form action="{{ route('comment.destroy', $comment->id) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="border-0 bg-transparent text-danger p-0 small">Delete</button>
                                            </form>
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <!-- Modal for confirming post deletion -->
                    <div class="modal fade" id="delete-post-{{ $post->id }}" tabindex="-1" aria-labelledby="deletePostModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deletePostModalLabel">Confirm Deletion</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this post?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<div class="d-flex justify-content-center">
        {{ $all_posts->links() }}
</div>

@endsection
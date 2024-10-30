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
            font-size: 1.5rem; /* カウントのフォントサイズを調整 */
            margin-left: 5px; /* アイコンとカウントの間のスペース */
        }
        .icon-lg {
            font-size: 1.5rem; /* アイコンのサイズを大きくする */
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
                                    <img src="{{ $post->user->avatar }}" alt="{{ $post->user->name }}" class="rounded-circle avatar">
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
                                <button class="dropdown-item text-danger" data-bs-toggle="modal"
                                    data-bs-target="#delete-post-{{ $post->id }}">
                                    <i class="fa-regular fa-trash-can"></i>Delete
                                </button>
                            </div>
                        </div>
                    </div>

                    @if ($post->image)
                        <img src="{{ $post->image }}" alt="Post ID {{ $post->id }}" class="w-100 mb-3">
                    @endif

                    <div class="mt-3">
                        <h4 class="fw-bold">Title: {{ $post->title }}</h4>
                        <strong>Date:</strong> {{ date('M d, Y', strtotime($post->date)) }}<br>
                        <strong>Reservation Due Date:</strong> {{ date('M d, Y', strtotime($post->reservation_due_date)) }}<br>
                        <strong>Place:</strong> {{ $post->place }}<br>
                        <strong>Participation Fee:</strong> {{ $post->participation_fee }}<br>
                        <strong>Planned Number of People:</strong> {{ $post->planned_number_of_people }}<br>
                        <p class="fw-light">{{ $post->description }}</p>
                        <p class="text-uppercase text-muted xsmall">{{ date('M d, Y', strtotime($post->created_at)) }}</p>
                    </div>

                    <div class="text-end">
                        <!-- 人物アイコン：参加者リストページへのリンク -->
                        <a href="#" class="btn btn-sm shadow-none p-0">
                            <i class="fa-solid fa-user icon-lg"></i> <!-- アイコンのサイズを大きく -->
                            <span class="icon-count">{{ $post->books->count() }}</span> <!-- カウントのフォントサイズを調整 -->
                        </a>

                        <!-- ハートアイコン：ブック機能のリンク -->
                        @if($post->isBooked())
                            <form action="{{ route('bookings.destroy', $post->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm shadow-none p-0" title="Cancel Booking">
                                    <i class="fa-solid fa-heart text-danger icon-lg"></i> <!-- アイコンのサイズを大きく -->
                                </button>
                            </form>
                        @else
                            <a href="{{ route('bookings.show', $post->id) }}" class="btn btn-sm p-0" title="Book this Post">
                                <i class="fa-regular fa-heart text-danger icon-lg"></i> <!-- アイコンのサイズを大きく -->
                            </a>
                        @endif
                    </div>
                                
                    <hr>

                    <!-- コメント機能 -->
                    <form action="#" method="post">
                        @csrf
                        <div class="input-group">
                            <textarea name="comment_body{{ $post->id }}" rows="1" class="form-control form-control-sm"
                                      placeholder="Add a comment..." required>{{ old('comment_body' . $post->id) }}</textarea>
                            <button class="btn btn-outline-secondary btn-sm">Post</button>
                        </div>
                        @error('comment_body_' . $post->id)
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </form>
                    
                    <hr>
                </div>
            </div>
        </div>
    </div>

    @include('posts.contents.modals.delete', ['post' => $post])
@endsection

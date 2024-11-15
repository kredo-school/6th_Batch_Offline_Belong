@extends('layouts.app')

@section('title', 'Approve Show Post')

@section('content')
<style>
    .card-body {
        position: relative;
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
                            <a href="{{ route('posts.approveedit', $post->id) }}" class="dropdown-item">
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
            </div>
        </div>
    </div>
</div>
<br>
<br>
<br>

@include('posts.contents.modals.delete', ['post' => $post])
@endsection

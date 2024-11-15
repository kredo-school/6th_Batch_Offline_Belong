@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <h1 class="text-center" style="font-size: 3rem; font-weight: bold;">
            Profile - {{ $user->name }}
        </h1>

        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        <div class="d-flex align-items-center">
            <div class="profile_image mb-3">
                @if ($user->profile_image)
                    <img src="{{ $user->profile_image }}" alt="Profile Image" class="rounded-image">
                @else
                    <i class="fa-solid fa-circle-user fa-5x"></i>
                @endif
            </div>
            <div class="ml-4">
                <h3>Your Posts: {{ $user->postCount() }}</h3>
            </div>
        </div>

        <div class="profile-details mt-4">
            <p class="mb-3"><strong>Age:</strong> {{ $user->age ?? 'Not specified' }}</p>
            <p class="mb-3"><strong>Gender:</strong> {{ $user->gender ?? 'Not specified' }}</p>
            <p><strong>Bio:</strong></p>
            <div class="bio-box">
                <p>{{ $user->bio ?? 'No bio available' }}</p>
            </div>
        </div>

        @if (Auth::check() && Auth::user()->id == $user->id)
            <a href="{{ route('profile.edit') }}" class="btn-link mt-3">Edit Profile</a>
        @endif

        <hr>

        <div class="user-posts mt-5">
            @if($posts->count())
                <div class="row">
                    @foreach ($posts as $post)
                        @if($post->approved || auth()->check() && auth()->id() === $post->user_id)
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <div class="card-img-top text-center" style="position: relative;">
                                        @if($post->image)
                                            @if($post->approved == 0 || $post->approved == 2)
                                                <!-- If post is not approved or rejected, redirect to the approve page -->
                                                <a href="{{ route('approve.show', $post->id) }}">
                                                    <img src="{{ $post->image }}" alt="Post ID {{ $post->id }}" class="image-lg" style="width: 100%; height: auto; object-fit: cover;">
                                                </a>
                                            @else
                                                <!-- If approved, show post -->
                                                <a href="{{ route('posts.show', $post->id) }}">
                                                    <img src="{{ $post->image }}" alt="Post ID {{ $post->id }}" class="image-lg" style="width: 100%; height: auto; object-fit: cover;">
                                                </a>
                                            @endif
                                        @else
                                            <img src="{{ url('images/homepage.jpg') }}" alt="Default Image" style="width: 100%; height: auto;">
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <h4 class="fw-bold">Title: {{ $post->title }}</h4>
                                        <div class="col text-start mb-1">
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
                                        @if ($post->approved == 0)
                                        <div class="badge bg-danger">
                                            Not Approved
                                        </div>
                                        @elseif ($post->approved == 1)
                                            <div class="badge bg-success">
                                                Approved
                                            </div>
                                        @elseif ($post->approved == 2)
                                            <div class="badge bg-warning">
                                                Rejected
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <!-- ページネーション -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $posts->links() }}
                </div>
            @else
                <p class="text-muted">No posts available.</p>
            @endif
        </div>
    </div>
    <br>
    <br>
    <br>
@endsection

<style>
    .rounded-image {
        width: 250px;
        height: 250px;
        border-radius: 50%;
        object-fit: cover;
    }
    .ml-4 {
        margin-left: 2rem;
    }
    .btn-link {
        display: inline-block;
        padding: 0.5rem 1rem;
        color: #fff;
        background-color: #6c757d;
        border-radius: 0.25rem;
        text-decoration: none;
        font-size: 1rem;
    }
    .btn-link:hover {
        background-color: #5a6268;
        text-decoration: none;
    }
    .profile-details p {
        font-size: 1.2rem;
        margin: 0.5rem 0;
    }
    .bio-box {
        border: 2px solid black;
        padding: 1rem;
        margin-top: 0.5rem;
        background-color: transparent;
        border-radius: 5px;
    }
</style>

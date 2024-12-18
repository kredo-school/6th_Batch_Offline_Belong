@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center" style="font-size: 3rem; font-weight: bold;">
            Profile - {{ $user->name }}
        </h1>

        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        <div class="d-flex align-items-center">
            <div class="profile-image mb-3">
                @if ($user->profile_image)
                    <img src="{{ $user->profile_image }}" alt="Profile Image" class="rounded-image" style="width: 150px; height: 150px;">
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
            <a href="{{ route('profile.edit') }}" class="btn-link mt-3" style="text-decoration: none;">Edit Profile</a>
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
                                                <a href="{{ route('approve.show', $post->id) }}">
                                                    <img src="{{ $post->image }}" alt="Post ID {{ $post->id }}" class="image-lg">
                                                </a>
                                            @else
                                                <a href="{{ route('posts.show', $post->id) }}">
                                                    <img src="{{ $post->image }}" alt="Post ID {{ $post->id }}" class="image-lg">
                                                </a>
                                            @endif
                                        @else
                                            <img src="{{ url('images/homepage.jpg') }}" alt="Default Image" class="image-lg">
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
                                            <div class="badge bg-danger w-25">Not Approved</div>
                                        @elseif ($post->approved == 1)
                                            <div class="badge bg-success w-25">Approved</div>
                                        @elseif ($post->approved == 2)
                                            <div class="badge bg-warning w-25">Rejected</div>
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
    /* プロフィール画像を丸く表示 */
    .rounded-image {
        width: 250px;
        height: 250px;
        border-radius: 50%;
        object-fit: cover;
    }

    /* 左側のプロフィール情報との間隔 */
    .ml-4 {
        margin-left: 2rem;
    }

    /* プロフィール編集リンクのスタイル */
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

    /* プロフィールの詳細情報 */
    .profile-details p {
        font-size: 1.2rem;
        margin: 0.5rem 0;
    }

    /* 自己紹介のボックス */
    .bio-box {
        border: 2px solid black;
        padding: 1rem;
        margin-top: 0.5rem;
        background-color: transparent;
        border-radius: 5px;
    }

    /* 投稿カードの画像をサイズ統一 */
    .card-img-top img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .card-body {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    /* ボタン内のテキスト調整 */
    .card-body a {
        font-size: 1rem;
    }



</style>

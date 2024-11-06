@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center" style="font-size: 3rem; font-weight: bold;">
        Profile - {{ $user->name }}
    </h1>

    @if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <div class="d-flex align-items-center">
        <!-- プロファイル画像の表示 -->
        <div class="profile-image mb-3">
            @if(isset($user) && $user->profile_image)
                <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile Image" class="rounded-image">
            @else
                <img src="{{ asset('path/to/default-image.jpg') }}" alt="Default Image" class="rounded-image"> <!-- デフォルト画像URLを指定 -->
            @endif
        </div>

        <!-- 投稿数の表示 -->
        <div class="ml-4">
            <h3>Your Posts: {{ $user->postCount() }}</h3> <!-- 投稿数を表示 -->
        </div>
    </div>

    <!-- 年齢、性別、自己紹介文の表示 -->
    <div class="profile-details mt-4">
        <p><strong>Age:</strong> {{ $user->age ?? 'Not specified' }}</p>
        <p><strong>Gender:</strong> {{ $user->gender ?? 'Not specified' }}</p>
        <p><strong>Bio:</strong> {{ $user->bio ?? 'No bio available' }}</p>
    </div>

    <!-- プロフィール編集リンク -->
    <a href="{{ route('profile.edit') }}" class="btn-link mt-3">Edit Profile</a>
    
    <br><br>
</div>
@endsection

<style>
.rounded-image {
    width: 250px; /* 幅を調整 */
    height: 250px; /* 高さを調整 */
    border-radius: 50%; /* 丸くする */
    object-fit: cover; /* 画像の収め方を調整 */
}
.ml-4 {
    margin-left: 2rem; /* 左マージンを増やす */
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
</style>

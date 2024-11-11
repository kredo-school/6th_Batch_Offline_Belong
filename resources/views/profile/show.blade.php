@extends('layouts.app')

@section('content')

{{ $user }}
<div class="container">
    <h1 class="text-center" style="font-size: 3rem; font-weight: bold;">
        Profile - {{ $user->name }}
    </h1>

    @if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <div class="d-flex align-items-center">
        <!-- プロファイル画像の表示 -->
        <div class="profile_image mb-3">
            @if($user->profile_image)
                <!-- 画像のURLが正しく保存されていれば、画像を表示 -->
                <img src="{{ $user->image }}" alt="Profile Image" class="rounded-image">
            @else
                <!-- デフォルト画像を表示 -->
                 <i class="fa-solid fa-circle-user fa-5x"></i>
            @endif
        </div>

        <!-- 投稿数の表示 -->
        <div class="ml-4">
            <h3>Your Posts: {{ $user->postCount() }}</h3> <!-- 投稿数を表示 -->
        </div>
    </div>

    <!-- 年齢、性別、自己紹介文の表示 -->
    <div class="profile-details mt-4">
        <p class="mb-3"><strong>Age:</strong> {{ $user->age ?? 'Not specified' }}</p>
        <p class="mb-3"><strong>Gender:</strong> {{ $user->gender ?? 'Not specified' }}</p>

        <!-- 自己紹介文のみを枠内に表示 -->
        <p><strong>Bio:</strong></p>
        <div class="bio-box">
            <p>{{ $user->bio ?? 'No bio available' }}</p>
        </div>
    </div>

    <!-- プロフィール編集リンク (自分のプロフィールの場合のみ表示) -->
    @if(Auth::check() && Auth::user()->id == $user->id)
        <a href="{{ route('profile.edit') }}" class="btn-link mt-3">Edit Profile</a>
    @endif

    <br><br>
    <br>
    <br>

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
.bio-box {
    border: 2px solid black; /* 枠線を透明にする */
    padding: 1rem; /* 内側の余白 */
    margin-top: 0.5rem; /* 上部の余白 */
    background-color: transparent; /* 背景色を透明にする */
    border-radius: 5px; /* 角丸にする */
}
</style>

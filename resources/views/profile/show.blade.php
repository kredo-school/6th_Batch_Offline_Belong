@extends('layouts.app')    

@section('content')
<div class="container">
    <h1 class="text-center">Profile - {{ $user->name }}</h1> <!-- ユーザーネームを表示 -->

    @if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <div class="d-flex">
        <!-- プロファイル画像の表示 -->
        <div class="profile-image mb-3">
            @if(isset($profile) && $profile->profile_image)
                <img src="{{ asset('storage/' . $profile->profile_image) }}" alt="Profile Image" class="rounded-image">
            @else
                <img src="default-image-url" alt="Default Image" class="rounded-image"> <!-- デフォルト画像を指定 -->
            @endif
        </div>

        <!-- 投稿数の表示 -->
        <div class="ml-3">
            <h4>Your Posts: {{ $user->postCount() }}</h4> <!-- 投稿数を表示 -->
        </div>
    </div>

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data"> 
        @csrf

        <div class="form-group">
            <label for="age">Age</label>
            <input type="number" name="age" id="age" class="form-control" value="{{ old('age', $profile->age ?? '') }}">
        </div>

        <div class="form-group">
            <label for="gender">Gender</label>
            <input type="text" name="gender" id="gender" class="form-control" value="{{ old('gender', $profile->gender ?? '') }}">
        </div>

        <div class="form-group">
            <label for="bio">Bio</label>
            <textarea name="bio" id="bio" class="form-control">{{ old('bio', $profile->bio ?? '') }}</textarea>
        </div>

        <a href="{{ route('profile.edit') }}" class="btn btn-secondary mt-3">Edit Profile</a>
    </form>
</div>
@endsection

<style>
.rounded-image {
    width: 250px; /* 幅を調整 */
    height: 250px; /* 高さを調整 */
    border-radius: 50%; /* 丸くする */
    object-fit: cover; /* 画像の収め方を調整 */
}
</style>

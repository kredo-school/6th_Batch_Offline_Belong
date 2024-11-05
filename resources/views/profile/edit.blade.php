@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center" style="font-size: 3rem; font-weight: bold;">
        Edit Profile
    </h1>

    @if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <!-- プロファイル画像の表示 -->
    <div class="profile-image mb-3">
        @if($user && $user->profile_image)
            <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile Image" class="rounded-image" style="width: 250px; height: 250px;">
        @else
            <img src="default-image-url" alt="Default Image" class="rounded-image" style="width: 250px; height: 250px;">
        @endif
    </div>

    <form action="{{ route('profile.update', ['id' => Auth::id()]) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="profile_image">Profile image (JPEG, PNG, max 2MB)</label>
            <input type="file" name="profile_image" class="form-control" accept="image/*">
        </div>

        <div class="form-group">
            <label for="age">Age</label>
            <input type="number" name="age" class="form-control" value="{{ old('age', $user->profile->age ?? '') }}">
        </div>

        <div class="form-group">
            <label for="gender">Gender</label>
            <select name="gender" class="form-control">
                <option value="">Please select</option>
                <option value="男性" {{ (old('gender', $user->profile->gender ?? '') == '男性') ? 'selected' : '' }}>男性</option>
                <option value="女性" {{ (old('gender', $user->profile->gender ?? '') == '女性') ? 'selected' : '' }}>女性</option>
                <option value="その他" {{ (old('gender', $user->profile->gender ?? '') == 'その他') ? 'selected' : '' }}>その他</option>
            </select>
        </div>

        <div class="form-group">
            <label for="bio">Self-introduction</label>
            <textarea name="bio" class="form-control">{{ old('bio', $user->profile->bio ?? '') }}</textarea>
        </div>
        <br>

        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
    <br>
</div>
@endsection

<!-- CSSのスタイル定義 -->
<style>
    .rounded-image {
        width: 250px;
        height: 250px;
        border-radius: 50%; /* 画像を丸くする */
        object-fit: cover; /* 画像をコンテナにフィットさせる */
    }
</style>

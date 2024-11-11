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
    <div class="profile_image mb-3">
        @if($user && $user->image)
            <!-- 画像がある場合、データベースに保存されたパスを表示 -->
            <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile Image" class="rounded-image">
        @else
            <!-- 画像がない場合、デフォルト画像を表示 -->
            <img src="{{ asset('storage/profile_images/default-image.jpg') }}" alt="Default Image" class="rounded-image"> <!-- デフォルト画像URL -->
        @endif
    </div>

    <!-- プロフィール編集フォーム -->
    <form action="{{ route('profile.update', ['id' => Auth::id()]) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="profile_image">Profile Image (JPEG, PNG, max 2MB)</label>
            <input type="file" name="image" class="form-control" >
        </div>

        <div class="form-group">
            <label for="age">Age</label>
            <input type="number" name="age" class="form-control" value="{{ old('age', $user->age ?? '') }}">
        </div>

        @php
            $selectedGender = old('gender', $user->gender ?? '');
        @endphp

        <div class="form-group">
            <label for="gender">Gender</label>
            <select name="gender" class="form-control">
                <option value="">Please select</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
        </div>


        <div class="form-group">
            <label for="bio">Self-introduction</label>
            <textarea name="bio" class="form-control">{{ old('bio', $user->bio ?? '') }}</textarea>
        </div>
        <br>

        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
    <br>
    <br>
    <br>
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

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
                <img src="default-image-url" alt="Default Image" class="rounded-image"> <!-- デフォルト画像を指定 -->
            @endif
        </div>

        <!-- 投稿数の表示 -->
        <div class="ml-4"> <!-- ここで ml-4 クラスまたはスタイル属性で余白を調整 -->
            <h3>Your Posts: {{ $user->postCount() }}</h3> <!-- 投稿数を表示 -->
        </div>
    </div>

    <!-- プロフィール編集フォーム -->
    <form action="{{ route('profile.edit') }}" method="POST" enctype="multipart/form-data"> 
        @csrf

        <div class="form-group">
            <label for="age">Age</label>
            <input type="number" name="age" id="age" class="form-control" value="{{ old('age', $user->profile->age ?? '') }}">
        </div>

        <div class="form-group">
            <label for="gender">Gender</label>
            <select name="gender" id="gender" class="form-control">
                <option value="">Please select</option>
                <option value="男性" {{ (old('gender', $user->profile->gender ?? '') == '男性') ? 'selected' : '' }}>Male</option>
                <option value="女性" {{ (old('gender', $user->profile->gender ?? '') == '女性') ? 'selected' : '' }}>Female</option>
                <option value="その他" {{ (old('gender', $user->profile->gender ?? '') == 'その他') ? 'selected' : '' }}>Other</option>
            </select>
        </div>

        <div class="form-group">
            <label for="bio">Bio</label>
            <textarea name="bio" id="bio" class="form-control">{{ old('bio', $user->profile->bio ?? '') }}</textarea>
        </div>

        <button type="submit" class="btn btn-secondary mt-3">Edit Profile</button>
        
    </form>
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
</style>

@extends('layouts.app') 

@section('content')
<div class="container">
    <h1>プロフィール編集</h1>

    @if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <!-- プロファイル画像の表示 -->
    <div class="profile-image mb-3">
        @if($profile && $profile->profile_image)
            <img src="{{ asset('storage/' . $profile->profile_image) }}" alt="Profile Image" class="rounded-image">
        @else
            <img src="default-image-url" alt="Default Image" class="rounded-image"> <!-- デフォルト画像を指定 -->
        @endif
    </div>

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="profile_image">プロファイル画像 (JPEG, PNG, 最大2MB)</label>
            <input type="file" name="profile_image" class="form-control" accept="image/*">
        </div>

        <div class="form-group">
            <label for="age">年齢</label>
            <input type="number" name="age" class="form-control" value="{{ old('age', $profile->age ?? '') }}">
        </div>

        <div class="form-group">
            <label for="gender">性別</label>
            <select name="gender" class="form-control">
                <option value="">選択してください</option>
                <option value="男性" {{ (old('gender', $profile->gender ?? '') == '男性') ? 'selected' : '' }}>男性</option>
                <option value="女性" {{ (old('gender', $profile->gender ?? '') == '女性') ? 'selected' : '' }}>女性</option>
                <option value="その他" {{ (old('gender', $profile->gender ?? '') == 'その他') ? 'selected' : '' }}>その他</option>
            </select>
        </div>

        <div class="form-group">
            <label for="bio">自己紹介</label>
            <textarea name="bio" class="form-control">{{ old('bio', $profile->bio ?? '') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">更新</button>
    </form>
</div>
@endsection

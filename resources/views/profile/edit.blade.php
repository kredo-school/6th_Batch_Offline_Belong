@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-7">
                <form action="{{ route('profile.update', $user->id) }}" method="post" enctype="multipart/form-data" class="p-5 shadow">
                    @csrf
                    @method('patch')
                    <div class="row mb-3">
                        <div class="col text-center">
                            @if ($user->profile_image)
                                <img src="{{ $user->profile_image }}" alt="Profile Image" class="rounded-image">
                            @else
                                <i class="fa-solid fa-circle-user fa-10x"></i>
                            @endif
                        </div>
                        <div class="col-auto align-self-center">
                            <input type="file" name="profile_image" class="form-control">
                            <div class="form-text text-danger small">
                                Acceptable formats: jpeg, jpg, png, gif (1MB max)
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="age" class="form-label fw-bold">Age</label>
                        <input type="number" name="age" id="age" class="form-control" value="{{ $user->age ?? '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label fw-bold">Gender</label>
                        <select name="gender" id="gender" class="form-select">
                            <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ $user->gender == 'other' ? 'selected' : '' }}>Other</option>
                            <option value="prefer_not_to_say" {{ $user->gender == 'prefer_not_to_say' ? 'selected' : '' }}>Prefer not to say</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="bio" class="form-label fw-bold">Bio</label>
                        <textarea name="bio" id="bio" rows="3" class="form-control">{{ $user->bio ?? '' }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-warning px-5">Save Profile</button>
                </form>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
@endsection

<!-- CSSのスタイル定義 -->
<style>
    .rounded-image {
        width: 150px; /* 画像の幅を指定 */
        height: 150px; /* 画像の高さを指定 */
        border-radius: 50%; /* 画像を丸くする */
        object-fit: cover; /* 画像をコンテナにフィットさせる */
    }
</style>

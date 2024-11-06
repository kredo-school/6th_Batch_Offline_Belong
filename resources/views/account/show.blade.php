@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center" style="font-size: 3rem; font-weight: bold;">
        Account - {{ $user->name }}
    </h1>

    @if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <div class="d-flex align-items-center">
        <!-- プロファイル画像の表示 -->
        <div class="profile-image mb-3">
            @if(isset($user) && $user->profile_image)
                <!-- 画像のURLが正しく保存されていれば、画像を表示 -->
                <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile Image" class="rounded-image">
            @else
                <!-- デフォルト画像を表示 -->
                <img src="{{ asset('storage/profile_images/default-image.jpg') }}" alt="Default Image" class="rounded-image"> <!-- デフォルト画像URL -->
            @endif
        </div>

        
    </div>
    <div class="container d-flex justify-content-center align-items-center vh-100">
            <div class="card p-5 shadow-lg rounded-3" style="max-width: 800px; width: 100%;">
                <h1 class="text-center mb-4">Register</h1>
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Row for Name and Email on the same line -->
                    <div class="row mb-3">
                        <!-- Name Field -->
                        <div class="col-md-6">
                            <label for="name" class="form-label">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Email Field -->
                        <div class="col-md-6">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                required autocomplete="new-password">
                        </div>
                    </div>
                    </form>
            </div>
        </div>

    

    <!-- プロフィール編集リンク (自分のプロフィールの場合のみ表示) -->
    @if(Auth::check() && Auth::user()->id == $user->id)
        <a href="{{ route('profile.edit') }}" class="btn-link mt-3">Edit Profile</a>
    @endif

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

</style>

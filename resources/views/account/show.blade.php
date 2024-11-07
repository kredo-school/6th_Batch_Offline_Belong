@extends('layouts.app') 

@section('content')
<div class="container">
    <h1 class="text-center" style="font-size: 3rem; font-weight: bold;">
        Account - {{ $user->name }}
    </h1>

    @if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <!-- プロファイル画像を中央に表示 -->
    <div class="d-flex justify-content-center mb-3">
        <div class="profile-image">
            @if(isset($user) && $user->profile_image)
                <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile Image" class="rounded-image">
            @else
                <img src="{{ asset('storage/profile_images/default-image.jpg') }}" alt="Default Image" class="rounded-image">
            @endif
        </div>
    </div>

    <div class="container d-flex justify-content-center">
        <div class="card p-5 shadow-lg rounded-3" style="max-width: 800px; width: 100%;">
            <h1 class="text-center mb-4">Information</h1>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name and Email Fields -->
                <div class="row mb-3">
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

                <!-- Age and Gender Fields -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="age" class="form-label">{{ __('Age') }}</label>
                        <input id="age" type="text" class="form-control @error('age') is-invalid @enderror"
                            name="age" value="{{ old('age') }}" required autocomplete="age" autofocus>

                        @error('age')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="gender" class="form-label">{{ __('Gender') }}</label>
                        <input id="gender" type="gender" class="form-control @error('gender') is-invalid @enderror"
                            name="gender" value="{{ old('gender') }}" required autocomplete="gender">

                        @error('gender')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- Password Fields -->
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control"
                            name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>
                <!-- プロフィール編集リンク (自分のプロフィールの場合のみ表示) -->
                @if(Auth::check() && Auth::user()->id == $user->id)
                    <a href="{{ route('account.edit') }}" class="btn-link mt-3">Edit information</a>
                @endif
            </form>
        </div>
    </div>

    

    <br><br>
</div>
@endsection

<style>
.rounded-image {
    width: 250px;
    height: 250px;
    border-radius: 50%;
    object-fit: cover;
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

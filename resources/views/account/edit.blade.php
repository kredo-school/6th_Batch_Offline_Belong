@extends('layouts.app')

@section('content')
    <div class="container mt-5"> <!-- mt-5: 上部に余白を追加 -->
        <div class="row justify-content-center">
            <div class="col-7">
            <h1 class="text-center" style="font-size: 3rem; font-weight: bold;">
                Edit Information - {{ $user->name }}
            </h1>
                <form action="{{ route('account.update', ['id' => $user->id]) }}" method="post" enctype="multipart/form-data" class="p-5 shadow">
                    @csrf
                    @method('patch')
                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('Name') }}</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="new-password">
                    </div>

                    <div class="mb-3">
                        <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control"
                            name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <button type="submit" class="btn btn-warning px-5">Save Information</button>
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
        width: 250px;
        height: 250px;
        border-radius: 50%;
        object-fit: cover;
    }
</style>

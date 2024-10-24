@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="styles.css">
        <style>
            body {
                background-image: url('images/background.jpg');
                background-size: cover;
                background-position: center;
            }
        </style>
    </head>

    <body>
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

                    <!-- Submit Button -->
                    <div class="row mb-0">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary" style="width: 50%;">
                                {{ __('Next→') }}
                            </button>
                        </div>
                    </div>


                    <p class="text-center mt-3">
                        <a href="login" class="text-decoration-none">→ Have an account?</a>
                    </p>


                </form>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>
@endsection

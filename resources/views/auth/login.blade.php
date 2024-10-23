@extends('layouts.app')

@section('content')
<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Login</title>
            <!-- Bootstrap CSS -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="styles.css">
            <style>
                body {
                        background-image: url('images/background.jpg'); /* Add your background image here */
                        background-size: cover;
                        background-position: center;
                    }
            </style>
        </head>
            <body>
                <div class="container d-flex justify-content-center align-items-center vh-100">
                        <div class="card p-5 shadow-lg rounded-3" style="max-width: 500px; width: 100%;">
                            <h1 class="text-center mb-4">Login</h1>
                            <form action="{{route('login')}}" method="POST">

                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" id="email" name="email" class="form-control" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" id="password" name="password" class="form-control" required>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Next →</button>
                                </div>

                                <p class="text-center mt-3">
                                    <a href="register" class="text-decoration-none">→ Create new account?</a>
                                </p>
                            </form>
                        </div>
                    </div>

                    <!-- Bootstrap JS -->
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
            </body>
    </html>
@endsection

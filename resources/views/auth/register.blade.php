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
                        background-image: url('images/background.jpg'); /* Add your background image here */
                        background-size: cover;
                        background-position: center;
                    }
            </style>
        </head>
            <body>
                <div class="container d-flex justify-content-center align-items-center vh-100">
                        <div class="card p-5 shadow-lg rounded-3" style="max-width: 800px; width: 100%;">
                            <h1 class="text-center mb-4">Register</h1>
                            <form action="/register" method="POST">
                                
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" id="username" name="username" class="form-control" required>
                                    </div>
                                    <div class="col">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" id="email" name="email" class="form-control" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="age" class="form-label">Age</label>
                                        <input type="number" id="age" name="age" class="form-control" required>
                                    </div>
                                    <div class="col">
                                        <label for="gender" class="form-label">Gender</label>
                                        <select id="gender" name="gender" class="form-select">
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" id="password" name="password" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="confirm_password" class="form-label">Confirm Password</label>
                                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Next →</button>
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

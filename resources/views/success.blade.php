<!-- resources/views/success.blade.php -->

@extends('layouts.app')

@section('content')
    <style>
        body {
            background-image: url('{{ asset('images/background.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
        }

        .card {
            max-width: 500px;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 2rem;
            border-radius: 0.75rem;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
    </style>

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card text-center">
            <h1>Payment Successful!</h1>
            <p>Your payment has been processed successfully.</p>
            <a href="{{ route('home') }}" class="btn btn-primary">Go to "Belong"</a>
        </div>
    </div>
@endsection


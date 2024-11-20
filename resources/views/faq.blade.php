@extends('layouts.app')  

@section('content')

<div class="container-fluid" style="position: relative; height: 100vh; padding: 0;">
    <img src="{{ asset('images/background.jpg') }}" alt="homeimage" style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0; z-index: -1;">
    <div class="d-flex justify-content-center align-items-center" style="height: 100%;">
        <div class="col-md-6 bg-white p-4 rounded">  <!-- Removed opacity class -->
            <h1 class="text-center">Contact Information</h1>
            <form action="{{ route('reception.store') }}" method="POST">
            @csrf
            <!-- Name Entry Field -->
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
            </div>
            <br>

            <!-- Email Entry Field -->
            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
            </div>
            <br>

            <!-- message Entry Field -->
            <div class="form-group">
                <label for="message">Message</label>
                <textarea class="form-control" id="message" name="message" rows="5" placeholder="Enter your message"></textarea>
            </div>
            <br>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
            @if(session('success'))
                <p style="color: green;">{{ session('success') }}</p>
            @endif
        </div>
    </div>
</div>

@endsection

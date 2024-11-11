@extends('layouts.app')  

@section('content')

<div class="container-fluid" style="position: relative; height: 100vh; padding: 0;">
    <img src="{{ asset('images/background.jpg') }}" alt="homeimage" style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0; z-index: -1;">
    <div class="d-flex justify-content-center align-items-center" style="height: 100%;">
        <div class="col-md-6 bg-white p-4 rounded">  <!-- Removed opacity class -->
            <h1 class="text-center">Withdrawal</h1>
            
            <!-- Name Entry Field -->
            <div class="form-group">
                <p>Are you sure you want to withdrawal?</p>
                <p>＊We will stop the payments starting next month.</p>               
                
            </div>
            <br>

            
            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>

@endsection

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

        .invalid {
            color: red; /* 入力が無効な場合の赤色表示 */
        }
    </style>

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-5 shadow-lg rounded-3" style="max-width: 500px; width: 100%; background-color: rgba(255, 255, 255, 0.9);">
            <h1 class="text-center mb-4">Withdrawal</h1>
            
            <form method="POST" action="" onsubmit="return validateForm()">
                <p>Are you sure you want to withdrawal?</p>
                <p>※We will stop the payments starting next month.</p>
                
                

                
            </form>
        </div>
    </div>

    
@endsection

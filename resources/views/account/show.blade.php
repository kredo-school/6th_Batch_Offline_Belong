@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center" style="font-size: 3rem; font-weight: bold;">
        Account - {{ $user->name }}
    </h1>

    @if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    <br>

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

    <br>
    <div class="container d-flex justify-content-center">
        <div class="card p-5 rounded-3" style="max-width: 800px; width: 100%;">
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
                
                <!-- Edit and Withdrawal Buttons -->
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('account.edit') }}" class="btn-link btn-edit">Edit information</a>
                    <a href="#" class="btn-link btn-withdrawal">Withdrawal</a>
                </div>
            </form>
        </div>
    </div>

    <br>
    <br>
</div>

<!-- Payment Card -->
<div class="container d-flex justify-content-center">
    <div class="card p-5 rounded-3" style="max-width: 800px; width: 100%; background-color: rgba(255, 255, 255, 0.9);">
        <h1 class="text-center mb-4">Payment</h1>
        <form method="POST" action="{{ route('payment.store') }}" onsubmit="return validateForm()">
            @csrf
            
            <div class="text-center mb-4">
                <img src="{{ asset('images/reservation-cards.png') }}" alt="Credit Card Logos" style="max-width: 100%; height: auto;">
            </div>

            <!-- カード番号 --> 
            <div class="mb-3">
                <label for="card_number" class="form-label">Card Number</label>
                <input type="text" id="card_number" name="card_number" class="form-control" required placeholder="1234 5678 9012 3456">
            </div>

            <!-- 有効期限 --> 
            <div class="mb-3">
                <label for="expiry_date" class="form-label">Expiration Date</label>
                <div class="d-flex">
                    <select id="expiry_month" name="expiry_month" class="form-control me-2" required>
                        <option value="" disabled selected>Month</option>
                        @for ($month = 1; $month <= 12; $month++)
                            <option value="{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}">{{ $month }}</option>
                        @endfor
                    </select>
                    <select id="expiry_year" name="expiry_year" class="form-control" required>
                        <option value="" disabled selected>Year</option>
                        @for ($year = date('Y'); $year <= date('Y') + 10; $year++)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
                    </select>
                </div>
            </div>

            <!-- CVV -->
            <div class="mb-3">
                <label for="cvv" class="form-label">CVV</label>
                <input type="text" id="cvv" name="cvv" class="form-control" required placeholder="***">
            </div>

            <!-- 名前 -->
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" id="name" name="name" class="form-control" required placeholder="JOHN KURT">
            </div>

            <!-- 送信ボタン -->
            <a href="#" class="btn-link btn-edit ">Edit Payment</a>
        </form>
    </div>
</div>
<br>
<br>
<br>
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
    border-radius: 0.25rem;
    text-decoration: none;
    font-size: 1rem;
}

/* Edit Button */
.btn-edit {
    background-color: #007bff; /* 青色 */
}

/* Withdrawal Button */
.btn-withdrawal {
    background-color: #dc3545; /* 赤色 */
}

/* ボタン間のスペース */
.d-flex.gap-3 > * {
    margin-right: 1rem;
}
</style>

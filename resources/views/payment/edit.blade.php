@extends('layouts.app')

@section('content')
    <div class="container mt-5"> <!-- mt-5: 上部に余白を追加 -->
        <div class="row justify-content-center">
            <div class="col-7">
                <h1 class="text-center" style="font-size: 3rem; font-weight: bold;">
                    Edit Payment - {{ $user->name }}
                </h1>
                <form action="{{ route('payment.update', $user->id) }}" method="post" enctype="multipart/form-data" class="p-5 shadow">
                    @csrf
                    @method('patch')

                    <!-- Card Number -->
                    <div class="mb-3">
                        <label for="card_number" class="form-label">Card Number</label>
                        <input id="card_number" type="text" class="form-control @error('card_number') is-invalid @enderror"
                            name="card_number" value="{{ old('card_number', $payment_cred->card_number) }}" required autocomplete="card_number">
                    </div>

                    <!-- Expiry Date -->
                    <div class="mb-3">
                        <label for="expiry_date" class="form-label">Expiration Date</label>
                        <div class="d-flex">
                            <select id="expiry_month" name="expiry_month" class="form-control me-2" required>
                                <option value="" disabled selected>Month</option>
                                @for ($month = 1; $month <= 12; $month++)
                                    <option value="{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}" 
                                        @if($payment_cred->expiry_month == str_pad($month, 2, '0', STR_PAD_LEFT)) selected @endif>
                                        {{ $month }}
                                    </option>
                                @endfor
                            </select>
                            <select id="expiry_year" name="expiry_year" class="form-control" required>
                                <option value="" disabled selected>Year</option>
                                @for ($year = date('Y'); $year <= date('Y') + 10; $year++)
                                    <option value="{{ $year }}" 
                                        @if($payment_cred->expiry_year == $year) selected @endif>
                                        {{ $year }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <!-- CVV -->
                    <div class="mb-3">
                        <label for="cvv" class="form-label">CVV</label>
                        <input type="text" id="cvv" name="cvv" class="form-control" required placeholder="***" 
                            value="{{ old('cvv', $payment_cred->cvv) }}">
                    </div>

                    <!-- Full Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" id="name" name="name" class="form-control" required placeholder="JOHN KURT"
                            value="{{ old('name', $payment_cred->name) }}">
                    </div>

                    <button type="submit" class="btn btn-warning px-5">Save Information</button>
                </form>
            </div>
        </div>
    </div>
    <br><br><br><br>
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

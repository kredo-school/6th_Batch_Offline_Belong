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
                            @for ($year = date('Y'); $year <= date('Y') + 10; $year++) <!-- 現在の年から10年後まで表示 -->
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
                <button type="submit" class="btn btn-primary form-control">Pay</button>
            </form>
        </div>
    </div>

    <script>
        function validateForm() {
            const cardNumberInput = document.getElementById('card_number');
            const cardNumber = cardNumberInput.value.replace(/\s+/g, ''); // スペースを除去
            const validLength = 16; // カード番号の桁数

            let isValid = true; // フォームが有効かどうかを追跡

            // カード番号の桁数が正しいか確認
            if (cardNumber.length !== validLength) {
                cardNumberInput.classList.add('invalid'); // 無効な場合はクラスを追加
                isValid = false; // フォームが無効であることを設定
            } else {
                cardNumberInput.classList.remove('invalid'); // 有効な場合はクラスを削除
            }

            // 有効期限の検証
            const expiryMonth = document.getElementById('expiry_month').value;
            const expiryYear = document.getElementById('expiry_year').value;
            if (!expiryMonth || !expiryYear) {
                document.getElementById('expiry_month').classList.add('invalid');
                document.getElementById('expiry_year').classList.add('invalid');
                isValid = false; // フォームが無効であることを設定
            } else {
                document.getElementById('expiry_month').classList.remove('invalid');
                document.getElementById('expiry_year').classList.remove('invalid');
            }

            // CVVの検証
            const cvvInput = document.getElementById('cvv');
            if (cvvInput.value.trim() === '') {
                cvvInput.classList.add('invalid');
                isValid = false; // フォームが無効であることを設定
            } else {
                cvvInput.classList.remove('invalid');
            }

            // 名前の検証
            const nameInput = document.getElementById('name');
            const nameValue = nameInput.value;

            // 名前が全て大文字でない場合
            if (nameValue !== nameValue.toUpperCase()) {
                nameInput.classList.add('invalid'); // 無効な場合はクラスを追加
                isValid = false; // フォームが無効であることを設定
            } else {
                nameInput.classList.remove('invalid'); // 有効な場合はクラスを削除
            }

            return isValid; // フォームの送信を制御
        }
    </script>
@endsection

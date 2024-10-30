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

        .terms-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .terms-container input[type="checkbox"] {
            margin-right: 0.5rem;
        }
    </style>

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card text-center">
            <h1>Payment Successful!</h1>
            <p>Your payment has been processed successfully.</p>

            <!-- 利用規約のチェックボックスとリンク -->
            <div class="rules-container">
                <input type="checkbox" id="rules">
                <label for="rules">
                    I agree to the <a href="{{ route('rules.page') }}" target="_blank" id="rules-link">Terms and Conditions</a>
                </label>
            </div>
            <br>

            <a href="#" class="btn btn-primary" id="continue-button">Go to "Belong"</a>
        </div>
    </div>

    <script>
        const rulesCheckbox = document.getElementById('rules');
        const continueButton = document.getElementById('continue-button');

        // ボタンがクリックされたときの動作
        continueButton.addEventListener('click', function(event) {
            if (!rulesCheckbox.checked) {
                event.preventDefault(); // チェックボックスがチェックされていない場合、デフォルトの動作をキャンセル
                alert("You must agree to the Terms and Conditions before proceeding."); // アラートを表示
            } else {
                window.location.href = "{{ route('home') }}"; // チェックが入っている場合はホームページへ移動
            }
        });
    </script>
@endsection

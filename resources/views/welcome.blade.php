<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+KR:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body {
            background-image: url('images/background.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0; 
            overflow: hidden;
            position: relative;
        }
        .welcome-text {
            text-align: center;
            color: white; /* 文字色を白に変更 */
            font-size: 75px; /* フォントサイズを100pxに変更 */
            font-weight: bold;
            margin: -80px 0; /* 上下のマージンを80pxに設定 */
            position: relative;
            z-index: 2;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.7); /* シャドウを追加 */
            padding: 20px; /* パディングを追加 */
            border-radius: 10px; /* 角を丸くする */
        }

        .card-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: 40px; /* カード間の横の間隔を広げる */
            z-index: 1;
            position: relative;
        }
        .card {
            width: 300px;
            height: auto;

            transition: transform 0.3s, box-shadow 0.3s;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* margin: 0 auto; カードを中央揃え */
        }
        .card img {
            width: 100%;
            height: 150px; /* すべての画像の高さを150pxに固定 */
            object-fit: cover; /* 画像がカード内に収まるように */
        }
        .card-body {
            padding: 10px;
        }
        .card-title {
            font-size: 16px;
            margin-bottom: 5px;
        }
        .card-text {
            font-size: 14px;
            margin-bottom: 0;
        }
        .card:hover {
            transform: scale(1.05) rotate(0deg); /* ホバー時に拡大と傾きリセット */
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        }
        .navbar {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('images/Belongicon.png') }}" alt="Logo" style="height: 75px; width: 75px;">
                        <span style="font-size: 36px; font-family: 'Noto Serif KR', serif; font-weight: 700;">
                            {{ config('app.name', 'Belong') }}
                        </span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto"></ul>
                    <ul class="navbar-nav ms-auto">
                        @guest
                            <li class="nav-item dropdown">
                                <a href="#" id="authDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-sign-in-alt text-black" style="font-size: 2rem;"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="authDropdown">
                                    @if (Route::has('login'))
                                        <li><a class="dropdown-item" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                                    @endif
                                    @if (Route::has('register'))
                                        <li><a class="dropdown-item" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                                    @endif
                                </ul>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-5 mt-5">
        
            <div class="container text-center mt-3 pt-5">
                <div class="welcome-text text-">Welcome to "Belong"</div>

                <div class="card-container mt-5">

                    <div class="card ms-5 mb--5" style="rotate: -20deg;">
                        <img src="{{ asset('images/toppage7.jpg') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Title: Let's play basebal</h5>
                            <p class="card-text">Let's play baseball together!<br>Everyone is welcome</p>
                            <p class="card-text"><small class="text-muted">Shohei</small></p>
                        </div>
                    </div>

                    <div class="card ms-5" style="rotate: 5deg;">
                        <img src="{{ asset('images/toppage2.jpg') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Title: Bread Making</h5>
                            <p class="card-text">Everyone who loves cooking is welcome!<br>Let's make delicious bread together!</p>
                            <p class="card-text"><small class="text-muted">Anpannman</small></p>
                        </div>
                    </div>
                    <div class="card ms-5" style="rotate: 15deg;">
                        <img src="{{ asset('images/toppage3.jpg') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Title: Museum</h5>
                            <p class="card-text">Let's enjoy art together!<br>Let's talk about art</p>
                            <p class="card-text"><small class="text-muted">Mona Lisa</small></p>
                        </div>
                    </div>
                    <div class="card mt--10" style="rotate: 10deg;">
                        <img src="{{ asset('images/toppage4.jpg') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Title: Nature</h5>
                            <p class="card-text">Let's visit the flower garden and enjoy nature!</p>
                            <p class="card-text"><small class="text-muted">Himawari</small></p>
                        </div>
                    </div>
                    <div class="card mt--10" style="rotate: -10deg;">
                        <img src="{{ asset('images/toppage5.jpg') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Title: Party</h5>
                            <p class="card-text">Cheers to togetherness!<br>Let's have a great time!</p>
                            <p class="card-text"><small class="text-muted">Buruzon</small></p>
                        </div>
                    </div>
                    <div class="card" style="rotate: -10deg;">
                        <img src="{{ asset('images/toppage6.jpg') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Title: Dinner</h5>
                            <p class="card-text">Let's enjoy some delicious food!<br>Let's have a great time</p>
                            <p class="card-text"><small class="text-muted"></small>Hero</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

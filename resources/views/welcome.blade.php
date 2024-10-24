<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
        .overlay {
            background-color: rgba(0, 0, 0, 0.5);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }
        .welcome-text {
            text-align: center;
            color: white;
            font-size: 40px;
            font-weight: bold;
            margin-bottom: 20px;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.8);
            position: relative;
            z-index: 2;
        }
        .card-columns {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            z-index: 1;
        }
        .card {
            width: 250px; /* カードの幅を広げる */
            height: auto; /* 高さを自動に */
            position: relative;
            transition: transform 0.3s;
            overflow: hidden; /* オーバーフローを隠す */
        }
        .card img {
            width: 100%; /* 画像の幅を100%に設定 */
            height: 150px; /* 固定の高さを設定 */
            object-fit: cover;
        }
        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: flex-start; /* 上寄せにする */
            padding: 10px; /* パディングを追加 */
        }
        .card-title {
            font-size: 16px; /* フォントサイズを調整 */
            margin-bottom: 5px; /* タイトルとテキストの間隔 */
        }
        .card-text {
            font-size: 14px; /* テキストのフォントサイズを調整 */
            margin-bottom: 0; /* マージンをゼロに */
        }
        .card:hover {
            transform: scale(1.05);
        }
        .text-white {
            color: white;
        }
        .navbar {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="overlay"></div>

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('images/Belongicon.png') }}" alt="Logo" style="height:100px; width: 100px;">
                    <span style="font-size: 36px;">
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
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
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

        <main class="py-5">
            <div class="container text-center mt-3 pt-5">
                <div class="welcome-text">Welcome to "Belong"</div>
                <div class="card-columns mt-5">
                    <div class="card">
                        <img src="{{ asset('images/toppage1.jpg') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Title: Flower Garden</h5>
                            <p class="card-text">This is a short review of the flower garden.</p>
                            <p class="card-text"><small class="text-muted">User Name</small></p>
                        </div>
                    </div>
                    <div class="card">
                        <img src="{{ asset('images/toppage2.jpg') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Title: Sunset View</h5>
                            <p class="card-text">A beautiful sunset captured in the heart of nature.</p>
                            <p class="card-text"><small class="text-muted">Another User</small></p>
                        </div>
                    </div>
                    <div class="card">
                        <img src="{{ asset('images/toppage3.jpg') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Title: Mountain Hike</h5>
                            <p class="card-text">Experiencing the beauty of mountain landscapes.</p>
                            <p class="card-text"><small class="text-muted">Third User</small></p>
                        </div>
                    </div>
                    <div class="card">
                        <img src="{{ asset('images/toppage4.jpg') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Title: Forest Adventure</h5>
                            <p class="card-text">Exploring the depths of the forest.</p>
                            <p class="card-text"><small class="text-muted">Fourth User</small></p>
                        </div>
                    </div>
                    <div class="card">
                        <img src="{{ asset('images/toppage5.jpg') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Title: City Life</h5>
                            <p class="card-text">A glimpse into the bustling city life.</p>
                            <p class="card-text"><small class="text-muted">Fifth User</small></p>
                        </div>
                    </div>
                    <div class="card">
                        <img src="{{ asset('images/toppage6.jpg') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Title: Night Sky</h5>
                            <p class="card-text">The beauty of the night sky filled with stars.</p>
                            <p class="card-text"><small class="text-muted">Sixth User</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>

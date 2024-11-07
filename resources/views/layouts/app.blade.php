<!doctype html>   
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Belong') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+KR:wght@400;700&display=swap" rel="stylesheet">

    <!-- FontAwesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- calendar -->
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' rel='stylesheet' />
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'></script>

    <script>
    $(document).ready(function() {
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events: [
                {
                    title: 'Event 1',
                    start: '2024-10-25'
                },
                {
                    title: 'Event 2',
                    start: '2024-10-27',
                    end: '2024-10-29'
                }
            ]
        });
    });
    </script>

    <style>
        html, body {
            height: 100%;
            width: 100%;
            margin: 0;
            padding: 0;
            overflow-x: hidden; /* 横スクロールを無効にする */
        }
        
        /* カレンダーを表示するカードのサイズと位置調整 */
        .calendar-card {
            width: 550px;
            margin-left: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        /* カレンダー自体のサイズと位置を指定 */
        #calendar {
            max-width: 500px;
            height: 450px;
            margin: 0 auto;
            overflow: hidden; /* カレンダー内の余分なスクロールを非表示にする */
        }

        /* ここにページ全体に対するレイアウト調整を追加 */
        main {
            width: 100%;
            height: calc(100% - 100px); /* ナビゲーションとフッターを除いた高さ */
            
        }

        /* フッターのスタイル */
        footer {
            background-color: #FDCEDF;
            padding: 20px;
            text-align: center;
            color: #333;
            bottom: 0;
            left: 0;
            
        }
        /* 検索フォームのスタイル */
        .search-form {
            display: flex;
            align-items: center;
        }

        .search-input {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-right: 5px;
        }

        .search-button {
            background-color: #FDCEDF;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 4px;
        }
        
    </style>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm mb-0">
    <div class="container">
        @if (Request::is('rules') || Request::is('payment') || Request::is('success'))
            <!-- ルール、ペイメント、サクセスページでは、クリックできないロゴとテキストを表示 -->
            <div class="navbar-brand">
                <img src="{{ asset('images/Belongicon.png') }}" alt="Logo" style="height: 75px; width: 75px;">
                <span style="font-size: 36px; font-family: 'Noto Serif KR', serif; font-weight: 700;">
                    {{ config('app.name', 'Belong') }}
                </span>
            </div>
        @else
            <!-- 他のページではクリック可能なロゴとテキストを表示 -->
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('images/Belongicon.png') }}" alt="Logo" style="height: 75px; width: 75px;">
                <span style="font-size: 36px; font-family: 'Noto Serif KR', serif; font-weight: 700;">
                    {{ config('app.name', 'Belong') }}
                </span>
            </a>
        @endif

        @if (!Request::is('rules') && !Request::is('success') && !Request::is('payment'))
            <div class="navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto"></ul>

                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else

                    <!-- 管理者用メニュー追加 -->
                    @if (Auth::user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.users') }}">Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#}">Posts</a>
                        </li>
                    @endif

                    <li class="nav-item dropdown">
                                <a class="nav-link" href="#" id="clipboardDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa-regular fa-clipboard" style="font-size: 30px;"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="searchDropdown">                                    
                                    <a class="dropdown-item" href="{{ route('posts.create') }}"><i class="fa-solid fa-circle-plus"></i> Create</a>
                                    <a class="dropdown-item" href="{{ route('posts.schedule') }}"><i class="fa-solid fa-calendar-days"></i> All Posts</a>                                   
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="#" id="heartDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa-regular fa-heart" style="font-size: 30px;"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="searchDropdown">                                    
                                    <a class="dropdown-item" href="{{ route('posts.booked') }}"><i class="fa-solid fa-heart"></i> Booked</a>
                                    <a class="dropdown-item" href="{{ route('posts.attended') }}"><i class="fa-solid fa-flag-checkered"></i> Attended</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="#" id="searchDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa-solid fa-magnifying-glass" style="font-size: 30px;"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="searchDropdown">                                    
                                    <a class="dropdown-item" href="{{ route('posts.search') }}"><i class="fa-solid fa-magnifying-glass"></i> Post</a>
                                    <a class="dropdown-item" href="{{ route('posts.search.user') }}"><i class="fa-solid fa-user-tag"></i> User</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><i class="fa-regular fa-bell" style="font-size: 30px;"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><i class="fas fa-cog" style="font-size: 30px;"></i></a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fa-solid fa-circle-user" style="font-size: 30px;"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ route('profile.show', ['id' => Auth::id()]) }}"><i class="fa-solid fa-id-badge"></i>  Profile</a> <!-- プロフィールボタン -->

                                    <!-- 管理者だけが表示されるリンク -->
                                    @if(auth()->user() && auth()->user()->role_id == 1) <!-- ユーザーが管理者かどうかをrole_idで確認 -->
                                        <a class="dropdown-item text-danger" href="#"><i class="fa-solid fa-user-tie"></i> Admin</a>
                                    @endif

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fa-solid fa-right-from-bracket"></i> {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                    @endguest
                </ul>
            </div>
        @endif
    </div>
</nav>


        <main class="py-0">
            @yield('content')
        </main>

        <footer style="background-color: #FDCEDF; padding: 20px; color: #333; display: flex; justify-content: space-between; align-items: center;"> 
            <p style="margin: 0;">© 2024 Belong. All rights reserved.</p>
            @if (!request()->is('login') && !request()->is('register') && !request()->is('rules') && !request()->is('success') && !request()->is('payment'))
            <div style="text-align: right; display: flex; align-items: center;">
                <a href="#"><i class="fa-brands fa-twitter" style="font-size: 24px; color: black; margin-left: 15px;"></i></a> <!-- Twitterの色を黒 -->
                <a href="#"><i class="fa-brands fa-facebook" style="font-size: 24px; color: blue; margin-left: 15px;"></i></a> <!-- Facebookの色を青 -->
                <a href="#"><i class="fa-brands fa-instagram" style="font-size: 24px; color: red; margin-left: 15px;"></i></a> <!-- Instagramの色を赤 -->        
                <a href="{{ route('footer.about') }}" class="about" style="margin-left: 15px;">About Us</a>
                <a href="{{ route('footer.faq') }}" class="faq" style="margin-left: 15px;">FAQ</a>
            </div>
            @endif
        </footer>

    </div>
</body>
</html>

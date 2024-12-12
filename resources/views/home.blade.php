@extends('layouts.app')

@section('content')

<style>
    /* カード全体に角丸を適用 */
    .card {
        height: 100%;
        display: flex;
        flex-direction: column;
        border-radius: 10px; /* カードの角丸 */
        overflow: hidden; /* 角丸を適用するためにオーバーフローを隠す */
    }

    /* 画像に角丸を適用 */
    .card-img-top img {
        width: 100%;
        height: 200px; /* 固定高さを指定 */
        object-fit: cover; /* サイズ調整 */
        border-top-left-radius: 10px; /* 上左角の丸み */
        border-top-right-radius: 10px; /* 上右角の丸み */
    }

    /* カードの本文をフレックスで下に配置 */
    .card-body {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    /* 画像を中央に配置 */
    .carousel-image {
        display: block;
        margin: 0 auto;
        width: 50%; /* 幅を50%に指定 */
        height: 300px;
        object-fit: cover;
    }

    /* リンクに黒色カーソルを設定 */
    .carousel-link {
        cursor: pointer;
    }

    /* カーソルが画像上に乗ったとき、画像の周りに少し変化を加える */
    .carousel-link:hover {
        opacity: 0.8;
    }

    .carousel-indicators button {
        background-color: black !important; /* 未選択時の色を黒に設定 */
        opacity: 1; /* 透明度を100%に設定 */
    }

    .carousel-indicators .active {
        background-color: #007bff !important; /* 選択中の色を青に設定 */
        opacity: 1; /* 透明度を100%に設定 */
    }


    .carousel-control-prev,
    .carousel-control-next {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 2;
        width: 5%; /* ボタンのクリック範囲を広げる */
    }

    .carousel-control-prev {
        left: -5%; /* 画像の左外側に配置 */
    }

    .carousel-control-next {
        right: -5%; /* 画像の右外側に配置 */
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: rgba(0, 0, 0, 0.5); /* 半透明の背景色を追加（任意） */
        border-radius: 50%; /* 丸みを追加（任意） */
        padding: 10px; /* ボタンアイコンの余白を調整 */
    }

</style>

<div class="container-fluid p-0">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card" style="margin-top: -1px;">
                <div class="card-header p-0 position-relative">
                    <!-- Carousel for 3 images -->
                    <div id="imageCarousel1" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('images/homepage.jpg') }}" alt="homeimage1" style="width:100%; height:500px; object-fit:cover;">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('images/homepage2.jpg') }}" alt="homeimage2" style="width:100%; height:500px; object-fit:cover;">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('images/homepage3.jpg') }}" alt="homeimage3" style="width:100%; height:500px; object-fit:cover;">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel1" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel1" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <div class="position-absolute top-50 start-50 translate-middle text-white" style="font-size: 70px; font-weight: bold; text-shadow: -1px -1px 0 red, 1px -1px 0 red, -1px 1px 0 red, 1px 1px 0 red;">
                        Welcome to "Belong"
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h5 style="font-size: 70px; font-weight: bold;">New Post</h5>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <div class="card mb-4" style="width: 400px;">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <i class="fa-regular fa-heart" style="font-size: 30px; margin-right: 10px;"></i>
                            <p class="mb-0">Booking button</p>
                        </div>
                        <div class="d-flex align-items-center">
                            <p class="mb-0" style="margin-left: 40px;">Click the heart icon to join the event!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br>
        <div class="row">
            @foreach ($posts as $post)
                @if ($post->approved)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-img-top text-center" style="position: relative;">
                                @if ($post->image)
                                    <a href="{{ route('posts.show', $post->id) }}">
                                        <img src="{{ $post->image }}" alt="Post ID {{ $post->id }}" class="image-lg">
                                    </a>
                                @else
                                    <img src="{{ url('images/homepage.jpg') }}" alt="Default Image" class="image-lg">
                                @endif
                            </div>
                            <div class="card-body">
                                <h4 class="fw-bold">Title: {{ $post->title }}</h4>
                                <div class="col text-start mb-1">
                                    @if ($post->categories->isNotEmpty())
                                        @foreach ($post->categories as $category)
                                            <div class="badge bg-secondary bg-opacity-50">
                                                {{ $category->name }}
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="badge bg-dark text-wrap">Uncategorized</div>
                                    @endif
                                </div>
                                <strong>Date:</strong> {{ date('M d, Y', strtotime($post->date)) }}<br>
                                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary mt-3">Detail</a>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    <br>
    <hr>

    <div class="container mt-4"> 
    <div class="row justify-content-center">
        <div class="col-md-12 text-center mb-4">
            <h5 style="font-size: 60px; font-weight: bold;">Big Event Posts</h5>
        </div>
    </div>

    @if(isset($message))
        <p class="text-center">{{ $message }}</p>
    @else
        <div class="card-header p-0 position-relative">
            <div id="imageCarousel2" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                <div class="carousel-inner">
                    @foreach($big_posts as $index => $post)
                        <a href="{{ route('posts.show', $post->id) }}" class="carousel-link">
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <img src="{{ $post->image }}" alt="{{ $post->title }}" class="carousel-image">
                            </div>
                        </a>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel2" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel2" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
                <div class="carousel-indicators">
                    @foreach($big_posts as $index => $post)
                        <button type="button" data-bs-target="#imageCarousel2" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"></button>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>




        <br>
        <br>
        <hr>
        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center mb-4">
                    <h5 style="font-size: 60px; font-weight: bold;">Sort post</h5>
                </div>
            </div>
            <div class="row g-4"> <!-- g-4 でカラム間の間隔を調整 -->
                <div class="col-md-3 col-sm-6"> <!-- 各カードを4分割 -->
                    <div class="card h-100"> <!-- h-100 で高さを揃える -->
                        <img src="{{ asset('images/play.jpg') }}" alt="Image 1" class="card-img-top"
                            style="object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">Play</h5>
                            <p class="card-text">Sports/Game etc.</p>
                            <a href="{{ route('category.play') }}" class="btn btn-primary">Detail</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card h-100">
                        <img src="{{ asset('images/Watch and Learn.jpg') }}" alt="Image 2" class="card-img-top"
                            style="object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">Watch and Learn</h5>
                            <p class="card-text">Nature/Culture etc.</p>
                            <a href="{{ route('category.watch-and-learn') }}" class="btn btn-primary">Detail</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card h-100">
                        <img src="{{ asset('images/eat.jpg') }}" alt="Image 3" class="card-img-top"
                            style="object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">Eat</h5>
                            <p class="card-text">Food/Drinking parties etc.</p>
                            <a href="{{ route('category.eat') }}" class="btn btn-primary">Detail</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card h-100">
                        <img src="{{ asset('images/others.jpg') }}" alt="Image 4" class="card-img-top"
                            style="object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">Others</h5>
                            <p class="card-text">Home party/Love affair/International etc.</p>
                            <a href="{{ route('category.others') }}" class="btn btn-primary">Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
       


        <br>
        <hr>
        <br>
        <div>
            

        <br>
        <br>
        <br>

    </div>
@endsection

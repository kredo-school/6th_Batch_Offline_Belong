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
</style>


    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card" style="margin-top: -1px;">
                    <div class="card-header p-0 position-relative">
                        <img src="{{ asset('images/homepage.jpg') }}" alt="homeimage"
                            style="width:100%; height:500px; object-fit:cover;">
                        <div class="position-absolute top-50 start-50 translate-middle text-white"
                            style="font-size: 70px; font-weight: bold; text-shadow:
                         -1px -1px 0 red,
                         1px -1px 0 red,
                         -1px 1px 0 red,
                         1px 1px 0 red;">
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
                                <p class="mb-0">booking button</p>
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
        <hr>
        <div class="container mt-4">
            <!-- セクションヘッダー -->
            <div class="row justify-content-center">
                <div class="col-md-12 text-center mb-4">
                    <h5 style="font-size: 60px; font-weight: bold;">Schedule Posts</h5>
                </div>
            </div>

            <!-- 検索フォーム -->
            <div class="row justify-content-center">
                <div class="col-md-6 text-center">
                    <form action="{{ route('posts.date') }}" method="GET">
                        <label for="dateSearch" class="form-label">Search by Date:</label>
                        <input type="date" id="dateSearch" name="date" class="form-control"
                            style="max-width: 300px; margin: 0 auto;" required>
                        <button type="submit" class="btn btn-primary mt-3">Search</button>
                    </form>
                </div>
            </div>

            <!-- 検索結果の表示 -->
            @if (isset($posts) && $posts->count() > 0)
                <div class="row justify-content-center mt-4">
                    <div class="col-md-8">
                        <h4 class="text-center mb-4">Search Results</h4>
                        @foreach ($posts->take(5) as $post)
                            <div class="row align-items-center mb-4 p-2 rounded border shadow-sm"
                                style="font-size: 14px;"> <!-- カードを小さく -->
                                <div class="col-auto">
                                    <a href="{{ route('posts.show', $post->id) }}">
                                        <!-- 投稿画像 -->
                                        @if ($post->image)
                                            <img src="{{ $post->image }}" alt="{{ $post->title }}" class="img-fluid"
                                                style="width: 50px; height: 50px; object-fit: cover;">
                                        @else
                                            <i class="fa-solid fa-image text-secondary" style="font-size: 2rem;"></i>
                                        @endif
                                    </a>
                                </div>
                                <div class="col ms-3">
                                    <a href="{{ route('posts.show', $post->id) }}"
                                        class="text-decoration-none text-dark">
                                        <p class="h5 mb-0">Title: {{ $post->title }}</p>
                                        <p class="text-muted mb-0">{{ Str::limit($post->content, 80) }}</p>
                                    </a>
                                </div>
                                <div class="col ms-3">
                                    <a href="{{ route('posts.show', $post->id) }}"
                                        class="text-decoration-none text-dark">
                                        <p class="h5 mb-0">reservation_date: {{ $post->reservation_due_date }}</p>
                                    </a>
                                </div>
                            </div>
                        @endforeach

                        @if (isset($_GET['date']))
                            {{ $posts->appends(['date' => $date])->links() }}
                        @endif

                        <!-- ページネーション -->

                    </div>
                </div>
            @elseif(isset($posts) && $posts->count() == 0)
                <!-- 件数が0の場合のメッセージ表示 -->
                <div class="row justify-content-center mt-4">
                    <div class="col-md-8 text-center">
                        <p class="lead text-muted">No posts found for the selected date.</p>
                    </div>
                </div>
            @endif
        </div>
        







        <br>
        <br>
        <br>
        <br>

    </div>
    <br>
    <br>
@endsection

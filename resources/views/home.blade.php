@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card" style="margin-top: -1px;">
                <div class="card-header p-0 position-relative">
                    <img src="{{ asset('images/homepage.jpg') }}" alt="homeimage" style="width:100%; height:500px; object-fit:cover;">
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

        <div class="row">
            @foreach ($posts as $post) <!-- 投稿をループで表示 -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-img-top text-center" style="position: relative;">
                            @if($post->image) <!-- 画像の存在を確認 -->
                                <a href="{{ route('posts.show', $post->id) }}">
                                    <img src="{{ $post->image }}" alt="Post ID {{ $post->id }}" class="image-lg" style="width: 100%; height: auto; object-fit: cover;">
                                </a>
                            @else
                                <img src="{{ url('images/homepage.jpg') }}" alt="Default Image" style="width: 100%; height: auto;"> <!-- デフォルト画像 -->
                            @endif
                        </div>
                        <div class="card-body">
                            <h4 class="fw-bold">Title: {{ $post->title }}</h4>
                            <div class="col text-start mb-1">
                                @if($post->categories->isNotEmpty())
                                    @foreach($post->categories as $category)
                                        <div class="badge bg-secondary bg-opacity-50">
                                            {{ $category->name }}
                                        </div>
                                    @endforeach
                                @else
                                    <div class="badge bg-dark text-wrap">Uncategorized</div>
                                @endif
                            </div>
                            <strong>Date:</strong> {{ date('M d, Y', strtotime($post->date)) }}<br>
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary mt-3">詳細</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row mt-2">
            <div class="col-md-12 text-end">
                <a href="#" style="font-size: 18px; color: blue; text-decoration: underline;">Suggest event</a>
            </div>
        </div>

        <hr>
        <div class="row justify-content-center">  
            <div class="col-md-6 d-flex justify-content-center">
                <div class="card mb-4" style="width: 600px; background-color: #F8E8EE;">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <i class="fa-solid fa-circle-exclamation" style="font-size: 30px; margin-right: 10px; color: white; text-shadow: 1px 1px 0 black;"></i>
                            <p class="mb-0" style="font-size: 20px;">notice</p>
                        </div>
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Your notice message here.</p>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>
    </div>

    <div class="container mt-4"><!-- カレンダーを表示する場所 -->
        <div class="row justify-content-center mt-5"> <!-- 上部マージンを増加し中央寄せ -->
            <div class="col-md-8 mt-5"> <!-- カレンダーのカラム -->
                <div class="card calendar-card"> <!-- calendar-cardクラスを追加 -->
                    <div class="card-header text-center">
                        <h5>カレンダー</h5>
                    </div>
                    <div class="card-body">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>

        <div class="col-md-3"> <!-- カードを配置するカラム -->
            <div class="text-left mb-2" style="margin-left: -260px;"> <!-- "Sort post"テキストを左に配置 -->
                <h5 style="font-size: 60px; font-weight: bold;">Sort post</h5>
            </div>
            <div class="row" style="margin-left: -260px; margin-top: 50px;"> <!-- カード用の行を追加し、左に配置 -->
                <div class="col-6 mb-4"> <!-- 1つ目のカード -->
                    <div class="card h-100"> <!-- h-100クラスを追加 -->
                        <div class="card-img-top text-center" style="position: relative;">
                            <img src="{{ asset('images/play.jpg') }}" alt="Image 1" style="width: 100%; height: auto;">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Play</h5> <!-- 画像名をタイトルに -->
                            <p class="card-text">Sports/Game etc.</p> <!-- 説明文 -->
                            <a href="{{ route('category.play') }}" class="btn btn-primary">詳細</a> <!-- ボタン -->
                        </div>
                    </div>
                </div>
                <div class="col-6 mb-4"> <!-- 2つ目のカード -->
                    <div class="card h-100"> <!-- h-100クラスを追加 -->
                        <div class="card-img-top text-center" style="position: relative;">
                            <img src="{{ asset('images/Watch and Learn.jpg') }}" alt="Image 2" style="width: 100%; height: auto;">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Watch and Learn</h5> <!-- 画像名をタイトルに -->
                            <p class="card-text">Nature/Culture etc.</p> <!-- 説明文 -->
                            <a href="{{ route('category.watch-and-learn') }}" class="btn btn-primary">詳細</a> <!-- ボタン -->
                        </div>
                    </div>
                </div>
                <div class="col-6 mb-4"> <!-- 3つ目のカード -->
                    <div class="card h-100"> <!-- h-100クラスを追加 -->
                        <div class="card-img-top text-center" style="position: relative;">
                            <img src="{{ asset('images/eat.jpg') }}" alt="Image 3" style="width: 100%; height: auto;">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Eat</h5> <!-- 画像名をタイトルに -->
                            <p class="card-text">Food/Drinking parties etc.</p> <!-- 説明文 -->
                            <a href="{{ route('category.eat') }}" class="btn btn-primary">詳細</a> <!-- ボタン -->
                        </div>
                    </div>
                </div>
                <div class="col-6 mb-4"> <!-- 4つ目のカード -->
                    <div class="card h-100"> <!-- h-100クラスを追加 -->
                        <div class="card-img-top text-center" style="position: relative;">
                            <img src="{{ asset('images/others.jpg') }}" alt="Image 4" style="width: 100%; height: auto;">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Others</h5> <!-- 画像名をタイトルに -->
                            <p class="card-text">Home party/Love affair/International etc.</p> <!-- 説明文 -->
                            <a href="{{ route('category.others') }}" class="btn btn-primary">詳細</a> <!-- ボタン -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
</div>
<br>
<br>
@endsection

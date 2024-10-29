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
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ Str::limit($post->content, 100) }}</p>
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">詳細</a>
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

    <!-- カレンダーを表示する場所 -->
    <div class="row justify-content-start mt-4"> <!-- 左揃え -->
        <div class="col-md-8"> <!-- カレンダーのカラム -->
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
                            <img src="{{ asset('images/image1.jpg') }}" alt="Image 1" style="width: 100%; height: auto;">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Image 1</h5> <!-- 画像名をタイトルに -->
                            <p class="card-text">ここに説明文を入れることができます。</p> <!-- 説明文 -->
                            <a href="#" class="btn btn-primary">詳細</a> <!-- ボタン -->
                        </div>
                    </div>
                </div>
                <div class="col-6 mb-4"> <!-- 2つ目のカード -->
                    <div class="card h-100"> <!-- h-100クラスを追加 -->
                        <div class="card-img-top text-center" style="position: relative;">
                            <img src="{{ asset('images/image2.jpg') }}" alt="Image 2" style="width: 100%; height: auto;">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Image 2</h5> <!-- 画像名をタイトルに -->
                            <p class="card-text">ここに説明文を入れることができます。</p> <!-- 説明文 -->
                            <a href="#" class="btn btn-primary">詳細</a> <!-- ボタン -->
                        </div>
                    </div>
                </div>
                <div class="col-6 mb-4"> <!-- 3つ目のカード -->
                    <div class="card h-100"> <!-- h-100クラスを追加 -->
                        <div class="card-img-top text-center" style="position: relative;">
                            <img src="{{ asset('images/image3.jpg') }}" alt="Image 3" style="width: 100%; height: auto;">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Image 3</h5> <!-- 画像名をタイトルに -->
                            <p class="card-text">ここに説明文を入れることができます。</p> <!-- 説明文 -->
                            <a href="#" class="btn btn-primary">詳細</a> <!-- ボタン -->
                        </div>
                    </div>
                </div>
                <div class="col-6 mb-4"> <!-- 4つ目のカード -->
                    <div class="card h-100"> <!-- h-100クラスを追加 -->
                        <div class="card-img-top text-center" style="position: relative;">
                            <img src="{{ asset('images/image4.jpg') }}" alt="Image 4" style="width: 100%; height: auto;">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Image sample</h5> <!-- 画像名をタイトルに -->
                            <p class="card-text">ここに説明文を入れることができます。</p> <!-- 説明文 -->
                            <a href="#" class="btn btn-primary">詳細</a> <!-- ボタン -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
</div>
@endsection

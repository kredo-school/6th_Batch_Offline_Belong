@extends('layouts.app') 

@section('content')
<div class="container-fluid p-0"> <!-- container-fluid に変更して横いっぱいにする -->
    <div class="row justify-content-center">
        <div class="col-md-12"> <!-- 横いっぱいにしたい場合は12カラム使う -->
            <div class="card" style="margin-top: -1px;"> <!-- マージンを調整 -->
                <div class="card-header p-0 position-relative"> <!-- p-0で余白をなくし、position-relative で子要素のabsoluteを扱う -->
                    <img src="{{ asset('images/homepage.jpg') }}" alt="homeimage" style="width:100%; height:500px; object-fit:cover;"> <!-- 高さ500pxで幅を自動調整 -->

                    <!-- 中央にテキストを配置 -->
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

    <!-- Notificationカードと"New Post"テキストを同じ行に配置 -->
    <div class="container mt-4">
        <div class="row align-items-center"> <!-- 縦中央揃え -->
            <div class="col-md-6"> <!-- 左側に"New Post" -->
                <h5 style="font-size: 70px; font-weight: bold;">New Post</h5>
            </div>
            <div class="col-md-6 d-flex justify-content-end"> <!-- 右側にNotificationカード -->
                <div class="card mb-4" style="width: 400px;"> <!-- サイズを設定 -->
                    <div class="card-body"> <!-- アイコンとテキストを左揃えで配置 -->
                        <div class="d-flex align-items-center"> <!-- アイコンと booking button を横並びに -->
                            <i class="fa-regular fa-heart" style="font-size: 30px; margin-right: 10px;"></i> <!-- アイコン -->
                            <p class="mb-0">booking button</p> <!-- booking buttonテキスト -->
                        </div>
                        <div class="d-flex align-items-center"> <!-- "Click the heart icon" のための新しいフレックスコンテナ -->
                            <p class="mb-0" style="margin-left: 40px;">Click the heart icon to join the event!</p> <!-- 説明テキスト -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Grid -->
        <div class="row">
            <div class="col-md-4 mb-4"> <!-- 1つ目のカード -->
                <div class="card">
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

            <div class="col-md-4 mb-4"> <!-- 2つ目のカード -->
                <div class="card">
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

            <div class="col-md-4 mb-4"> <!-- 3つ目のカード -->
                <div class="card">
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
        </div>

        <div class="row mt-4"> <!-- 下段のカードを新しい行として追加 -->
            <!-- 下段のカード -->
            <div class="col-md-4 mb-4"> <!-- 1つ目のカード -->
                <div class="card">
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

            <div class="col-md-4 mb-4"> <!-- 2つ目のカード -->
                <div class="card">
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

            <div class="col-md-4 mb-4"> <!-- 3つ目のカード -->
                <div class="card">
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
        </div>

        <!-- Suggest Postの表示 -->
        <div class="row mt-2"> <!-- 下に新しい行を追加 -->
            <div class="col-md-12 text-end"> <!-- 右揃え -->
                <a href="#" style="font-size: 18px; color: blue; text-decoration: underline;">Suggest event</a> <!-- URLテキスト -->
            </div>
        </div>

        <hr>
        <br>
        <div class="row justify-content-center"> <!-- 行を中央揃えにする -->  
            <div class="col-md-6 d-flex justify-content-center"> <!-- 右側にNotificationカードを中央に配置 -->
                <div class="card mb-4" style="width: 600px; background-color: #F8E8EE;"> <!-- サイズを設定し、背景色を変更 -->
                    <div class="card-body"> <!-- アイコンとテキストを左揃えで配置 -->
                        <div class="d-flex align-items-center"> <!-- アイコンと notice を横並びに -->
                            <i class="fa-solid fa-circle-exclamation" style="font-size: 30px; margin-right: 10px; color: white; text-shadow: 1px 1px 0 black, -1px -1px 0 black, -1px 1px 0 black, 1px -1px 0 black;"></i> <!-- アイコンの色を白に、輪郭を黒に -->
                            <p class="mb-0" style="font-size: 20px;">notice</p> <!-- noticeテキスト -->
                        </div>
                        <div class="d-flex align-items-center"> <!-- 説明テキストのための新しいフレックスコンテナ -->
                            <p class="mb-0" style="margin-left: 40px;">Please check the notification from the administrator</p> <!-- 説明テキスト -->
                        </div>
                        <div class="d-flex justify-content-start mt-3"> <!-- ボタンを左揃えに配置 -->
                            <a href="#" class="btn" style="background-color: black; color: white;">check</a> <!-- ボタン -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <br>
    

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
                        <h5 class="card-title">Image 4</h5> <!-- 画像名をタイトルに -->
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
</div>
@endsection

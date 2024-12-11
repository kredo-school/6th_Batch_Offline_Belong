@extends('layouts.app')

@section('content')

<head>
    <!-- 他の<head>要素 -->
    <link href="https://fonts.googleapis.com/css2?family=Patrick+Hand&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.8;
            margin: 0;
            padding: 0;
        }
        h1 {
            font-size: 60px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }
        .text-section {
            text-align: justify; /* テキストを整える */
        }
        .overlay-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-weight: bold;
            font-size: 46px;
            text-align: center;
        }
        .thank-you-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 30px;
        }
        .thank-you-section h3 {
            margin: 0;
        }
        .thank-you-section h1 {
            font-family: 'Patrick Hand', cursive;
            font-style: italic;
            margin: 0;
        }
    </style>
</head>

<div class="container-fluid p-0">
    <!-- ヘッダー画像セクション -->
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card" style="margin-top: -1px;">
                <div class="card-header p-0 position-relative">
                    <img src="{{ asset('images/about.jpg') }}" alt="homeimage" style="width:100%; height:500px; object-fit:cover;">
                    <div class="overlay-text">Welcome to Belong</div>
                </div>
            </div>
        </div>
    </div>

    <!-- コンテンツセクション -->
    <div class="row justify-content-center mt-5">
        <div class="col-md-8 text-section">
            <h1>About Us</h1>
            <br>
            <p>Welcome to Belong, a platform where every moment holds the potential for meaningful connections.</p>
            <p>In a world that often feels disconnected, we founded Belong with a simple yet powerful vision: to create a space where people can come together, share experiences, and build lasting relationships. Whether it's discovering local events, participating in community activities, or simply finding inspiration, Belong serves as the bridge that connects you to opportunities and people that resonate with your passions.</p>
            <p>Life is made richer through shared experiences, and we believe that every individual deserves a chance to find their place in the world. Belong is not just an app—it’s a gateway to endless possibilities. From meeting like-minded individuals to exploring new interests, we aim to be the catalyst for creating unforgettable memories and fostering relationships that matter.</p>
            <p>Our team is dedicated to designing a platform that goes beyond event discovery. We focus on crafting experiences that are intuitive, inclusive, and tailored to your unique preferences. Every event listed on Belong is an invitation to step out of your routine, explore new horizons, and discover the joy of connection.</p>
            <p>At Belong, we embrace diversity and value the unique stories that each person brings. Whether you’re attending a local art fair, joining a workshop, or celebrating cultural festivals, we believe that these moments are where magic happens—where strangers become friends, passions turn into projects, and connections transform into communities.</p>
            <p>We are driven by three guiding principles:</p>
            <ul>
                <li><strong>Fostering Connection:</strong> Life is better when we share it with others.</li>
                <li><strong>Empowering Discovery:</strong> The world is full of opportunities waiting to be explored.</li>
                <li><strong>Celebrating Inclusivity:</strong> Everyone deserves to feel seen, heard, and welcomed.</li>
            </ul>
            <p>Thank you for letting us be a part of your journey. Together, let’s create a world where everyone truly belongs.</p>

            <!-- サンクスセクション -->
            <div class="thank-you-section">
                <h3>Thank you very much!!</h3>
                <h1>Kurt John</h1>
            </div>
        </div>
    </div>
    <br>
</div>
<br>
<br>
<br>
<br>
@endsection

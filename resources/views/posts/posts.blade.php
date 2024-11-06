@extends('layouts.app')

@section('title', 'Explore Posts')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 col-sm-12"> <!-- カラムの幅をレスポンシブに調整 -->
            
            @auth
                @if(! request()->is('admin/*'))
                    <!-- サーチバーを中央に配置 -->
                    <div class="d-flex justify-content-center mb-5 mt-5">
                        <form action="{{ route('posts.search') }}" method="get" style="width: 100%">
                            <input type="search" name="query" class="form-control form-control-lg" placeholder="Search for posts..." value="{{ request()->query('query') }}">
                        </form>
                    </div>
                @endif
            @endauth

            <!-- 検索結果の表示 -->
            <p class="h4 text-muted mb-4 text-center">Search results for "<span class="fw-bold">{{ $query }}</span>"</p>

            @forelse($posts as $post)
                <div class="row align-items-center mb-4 p-3 rounded border shadow-sm">
                    <div class="col-auto">
                        <a href="{{ route('posts.show', $post->id) }}">
                            <!-- 投稿画像 -->
                            @if($post->image)
                                <img src="{{ $post->image }}" alt="{{ $post->title }}" class="img-fluid" style="width: 50px; height: 50px; object-fit: cover;"> <!-- 四角にするためborder-radiusを削除 -->
                            @else
                                <i class="fa-solid fa-image text-secondary" style="font-size: 2rem;"></i>
                            @endif
                        </a>
                    </div>
                    <div class="col ms-3">
                        <a href="{{ route('posts.show', $post->id) }}" class="text-decoration-none text-dark">
                            <p class="h5 mb-0">Title: {{ $post->title }}</p>
                            <p class="text-muted mb-0">{{ Str::limit($post->content, 100) }}</p>
                        </a>
                    </div>
                </div>
            @empty
                <p class="lead text-muted text-center">No posts found.</p>
            @endforelse
        </div>
    </div>
@endsection

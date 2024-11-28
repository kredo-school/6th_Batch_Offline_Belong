@extends('layouts.app')

@section('content')

<div class="container mt-4">
    
    <!-- 検索フォーム -->
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            <form action="{{ route('posts.date') }}" method="GET">
                <label for="dateSearch" class="form-label" style="font-size: 36px; font-weight: bold;">Search by Date:</label>
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
                @foreach ($posts as $post) 
                    <div class="row align-items-center mb-4 p-2 rounded border shadow-sm" style="font-size: 14px;">
                        <div class="col-auto">
                            <a href="{{ route('posts.show', $post->id) }}">
                                <!-- 投稿画像 -->
                                @if ($post->image)
                                    <img src="{{ $post->image }}" alt="{{ $post->title }}" class="img-fluid"
                                         style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px;">
                                @else
                                    <i class="fa-solid fa-image text-secondary" style="font-size: 2rem;"></i>
                                @endif
                            </a>
                        </div>
                        <div class="col ms-3">
                            <a href="{{ route('posts.show', $post->id) }}" class="text-decoration-none text-dark">
                                <p class="h5 mb-0">Title: {{ $post->title }}</p>
                                <p class="text-muted mb-0">{{ Str::limit($post->content, 80) }}</p>
                            </a>
                        </div>
                        <div class="col ms-3">
                            <a href="{{ route('posts.show', $post->id) }}" class="text-decoration-none text-dark">
                                <p class="h5 mb-0">reservation_date: {{ $post->reservation_due_date }}</p>
                            </a>
                        </div>
                    </div>
                @endforeach

                @if (isset($_GET['date']))
                    {{ $posts->appends(['date' => $date])->links() }} <!-- ページネーションリンク -->
                @endif
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

@endsection

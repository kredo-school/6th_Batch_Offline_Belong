@extends('layouts.app')

@section('title', 'Watch and Learn Posts')

@section('content')
<div class="container mt-5">
    <div class="row">
        @if ($posts->count() > 0)
            @foreach ($posts as $post)
                <div class="col-md-6">
                    @include('posts.post_card', ['post' => $post]) <!-- post_cardを共通化 -->
                </div>
            @endforeach

            <!-- ページネーション -->
            <div class="d-flex justify-content-start mt-4">
                {{ $posts->links() }}
            </div>
        @else
            <div class="col-12 text-center">
                <h4>No posts yet</h4>
            </div>
        @endif
    </div>
</div>
<br>
<br>
<br>
@endsection

@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
<style>
    .table-header-bg {
        background-color: #fdcdef;
    }
</style>
<div class="container mt-3">
    <h2>Past Attended Posts</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($attendedPosts->isEmpty())
        <p>No past posts attended.</p>
    @else
        <table class="table table-bordered text-center">
            <thead>
                <tr class="table-header-bg">
                    <th>Post</th>
                    <th>Title</th>
                    <th>Created By</th>
                    <th>Place</th>
                    <th>Fee</th>
                    <th>Date</th>
                    <th>Review</th>
                </tr>
            </thead>
            <tbody>
                @foreach($attendedPosts as $post)
                    @if ($post) <!-- $postがnullでない場合のみ処理を行う -->
                        <tr>
                            <td>
                                <a href="{{ route('posts.show', $post->id) }}">
                                    <img src="{{ $post->image }}" alt="{{ $post->title }}" style="width: 100px; height: auto;">
                                </a>
                            </td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->user->name }}</td>
                            <td>{{ $post->place }}</td>
                            <td>{{ $post->participation_fee }}</td>
                            <td>{{ $post->date }}</td>
                            <td>
                                <a href="{{ route('reviews.create', $post->id) }}" class="btn btn-outline-danger btn-sm">Write Review</a>
                                <a href="{{ route('reviews.index', $post->id) }}" class="btn btn-outline-primary btn-sm">View Review</a>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection

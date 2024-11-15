@extends('layouts.app')

@section('title', 'Admin: Approve Posts')

@section('content')
<style>
    .table th {
        background-color: #fdcdef; /* Change this to your desired background color */
    }
</style>
<div class="container">
    <div class="row mt-5">
        <!-- Admin Controls -->
        @if(request()->is('admin/*'))
            <div class="col-md-3 col-sm-12">
                <div class="list-group">
                    <a href="{{ route('admin.users') }}" class="list-group-item {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                        <i class="fa-solid fa-users"></i> Users
                    </a>
                    <a href="{{ route('admin.posts') }}" class="list-group-item {{ request()->routeIs('admin.posts') ? 'active' : '' }}">
                        <i class="fa-solid fa-newspaper"></i> Posts
                    </a>
                    <a href="{{ route('admin.approve.page') }}" class="list-group-item {{ request()->routeIs('admin.approve.page') ? 'active' : '' }}">
                        <i class="fa-solid fa-check-circle"></i> Approve
                    </a>
                </div>
            </div>
        @endif

        <!-- Pending Post Table -->
        <div class="col-md-9 col-sm-12">
            <h1>Approve Pending Posts</h1>
            @if(session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <table class="table table-hover align-middle bg-white border text-secondary">
                <thead class="small table-success text-secondary">
                    <tr>
                        <th>ID</th>
                        <th>Posts</th> <!-- Image column -->
                        <th>CATEGORY</th>
                        <th>TITLE</th>
                        <th>OWNER</th>
                        <th>CREATED AT</th>
                        <th>Actions</th> <!-- Actions column for approval, rejection and deletion -->
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendingPosts as $post)
                        <tr>
                            <td class="text-end">{{ $post->id }}</td>
                            <td>
                                <a href="{{ route('approve.show', $post->id) }}">
                                    <img src="{{ $post->image }}" alt="Post ID {{ $post->id }}" class="d-block mx-auto image-sm" style="width: 100px; height: auto;">
                                </a>
                            </td>
                            <td>
                                @forelse($post->categoryPost as $category_post)
                                    <span class="badge bg-secondary bg-opacity-50">
                                        {{ $category_post->category->name }}
                                    </span>
                                @empty
                                    <div class="badge bg-dark text-wrap">Uncategorized</div>
                                @endforelse
                            </td>
                            <td>{{ $post->title }}</td>
                            <td>
                                <a href="#" class="text-dark text-decoration-none">
                                    {{ $post->user->name }}
                                </a>
                            </td>
                            <td>{{ $post->created_at }}</td>
                            <td>
                                <!-- Approve button (Blue) -->
                                <form action="{{ route('admin.approve.post', $post->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-primary" style="width: 80px;">Approve</button>
                                </form>

                                <!-- Reject button (Red) -->
                                <form action="{{ route('admin.reject.post', $post->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger" style="width: 80px;">Reject</button>
                                </form>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="7" class="lead text-muted text-center">No posts pending approval.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $pendingPosts->links() }}
            </div>
        </div>
    </div>
</div>
<br><br><br>
@endsection

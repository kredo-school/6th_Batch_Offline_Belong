@extends('layouts.app')

@section('title', 'Admin: Approve Posts')

@section('content')
<style>
    .table th {
        background-color: #fdcdef; /* Change this to your desired background color */
    }
    .accordion-button {
        font-size: 0.9rem;
        border-radius: 5px;
        padding: 8px;
        background-color: #dc3545; /* Red background for reject button */
        color: white; /* Text color white */
        width: 100px; /* Same width for both buttons */
        height: 40px; /* Same height for both buttons */
        border-color: #dc3545; /* Matching border color */
        display: flex;
        align-items: center; /* Vertically center the text */
        justify-content: center; /* Horizontally center the text */
    }

    /* Ensure that the reject button always stays red */
    .accordion-button.btn-danger {
        background-color: #dc3545; /* Red background for reject button */
        border-color: #dc3545; /* Matching border color */
    }

    .accordion-button::after {
        display: none; /* Remove the arrow */
    }

    .accordion-body {
        background-color: #f8f9fa;
        padding: 10px;
    }

    /* Style for action buttons container */
    .action-buttons {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    /* Style for approve button */
    .btn-approve {
        background-color: #007bff;
        color: white;
        width: 100px;
        height: 40px;
        border-radius: 5px;
        font-size: 1rem;
        transition: background-color 0.3s;
    }

    .btn-approve:hover {
        background-color: #0056b3;
    }

    /* Style for reject button */
    .btn-reject {
        background-color: #dc3545;
        color: white;
        width: 100px;
        height: 40px;
        border-radius: 5px;
        font-size: 1rem;
        transition: background-color 0.3s;
    }

    .btn-reject:hover {
        background-color: #c82333;
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
                    <a href="{{ route('admin.notify') }}" class="list-group-item {{ request()->routeIs('admin.notify') ? 'active' : '' }}">
                        <i class="fa-solid fa-bell"></i> Notifications
                    </a>
                    <a href="{{ route('admin.receptions') }}" class="list-group-item {{ request()->routeIs('admin.receptions') ? 'active' : '' }}">
                    <i class="fa-solid fa-envelope"></i> Receptions
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
                                <!-- Action buttons container with flex layout -->
                                <div class="action-buttons">
                                    <!-- Approve button (Blue) -->
                                    <form action="{{ route('admin.approve.post', $post->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-approve">Approve</button>
                                    </form>

                                    <!-- Accordion for Reject Reason -->
                                    <div class="accordion" id="accordionRejectReason-{{ $post->id }}">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading-{{ $post->id }}">
                                                <button class="accordion-button btn btn-sm text-white text-center btn-danger" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $post->id }}" aria-expanded="false" aria-controls="collapse-{{ $post->id }}">
                                                    Reject
                                                </button>
                                            </h2>
                                            <div id="collapse-{{ $post->id }}" class="accordion-collapse collapse" aria-labelledby="heading-{{ $post->id }}" data-bs-parent="#accordionRejectReason-{{ $post->id }}">
                                                <div class="accordion-body">
                                                    <form action="{{ route('admin.reject.post', $post->id) }}" method="POST">
                                                        @csrf
                                                        <div class="form-group mb-2">
                                                            <textarea name="reject_reason" class="form-control" placeholder="Enter rejection reason..." required></textarea>
                                                        </div>
                                                        <!-- Reject button (Red) -->
                                                        <button type="submit" class="btn btn-sm btn-danger" style="width: 80px;">Submit</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

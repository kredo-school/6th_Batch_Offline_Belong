@extends('layouts.app')

@section('title', 'Admin: Posts')

@section('content')
<div class="container">
    <div class="row mt-5">
        <!-- Admin Controls -->
        @if(request()->is('admin/*'))
            <div class="col-md-3 col-sm-12">
                <div class="list-group">
                    <a href="{{ route('admin.users') }}" class="list-group-item {{ request()->is('admin.users') ? 'active':'' }}">
                        <i class="fa-solid fa-users"></i> Users
                    </a>
                    <a href="{{ route('admin.posts') }}" class="list-group-item {{ request()->is('admin.posts') ? 'active':'' }}">
                        <i class="fa-solid fa-newspaper"></i> Posts
                    </a>
                </div>
            </div>
        @endif

        <!-- Post Table -->
        <div class="col-md-9 col-sm-12">
            <table class="table table-hover align-middle bg-white border text-secondary">
                <thead class="small table-success  text-secondary">
                    <tr>
                        <th>ID</th>
                        <th>Posts</th> <!-- 画像列 -->
                        <th>CATEGORY</th>
                        <th>TITLE</th>
                        <th>OWNER</th>
                        <th>CREATED AT</th>
                        <th>ACTIONS</th> <!-- 削除列を追加 -->
                    </tr>
                </thead>
                <tbody>
                    @forelse($all_posts as $post)
                        <tr>
                            <td class="text-end">{{ $post->id }}</td>
                            <td>
                                <a href="{{ route('posts.show', $post->id) }}">
                                    <!-- 画像を小さく表示 -->
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
                                <!-- ユーザー名をリンクにするがリンク先は#に設定 -->
                                <a href="#" class="text-dark text-decoration-none">
                                    {{ $post->user->name }}
                                </a>
                            </td>
                            <td>{{ $post->created_at }}</td> <!-- 日付をフォーマットして表示 -->
                            <td>
                                <!-- 削除ボタン -->
                                <button class="btn btn-sm text-danger" data-bs-toggle="modal" data-bs-target="#delete-post-{{ $post->id }}">
                                    <i class="fa-solid fa-trash"></i> Delete
                                </button>
                            </td>
                        </tr>

                        <!-- 削除確認モーダル -->
                        <div class="modal fade" id="delete-post-{{ $post->id }}" tabindex="-1" aria-labelledby="delete-post-label" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="delete-post-label">Delete Post</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete this post?
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @empty
                        <tr>
                            <td colspan="7" class="lead text-muted text-center">No Posts Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $all_posts->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

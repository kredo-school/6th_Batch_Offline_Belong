@extends('layouts.app')

@section('content')

<!-- Post Table -->
<div class="col-md-9 col-sm-12 mx-auto">
    <table class="table table-hover align-middle bg-white border text-secondary w-100">
        <thead class="small table-success text-secondary">
            <tr>
                <th>Posts</th> <!-- 画像列 -->
                <th>CATEGORY</th>
                <th>TITLE</th>
                <th>OWNER</th>
                <th>DATE</th>
            </tr>
        </thead>
        <tbody>
            @forelse($all_posts as $post)
                <tr>
                    <td class="text-center">
                        <a href="{{ route('posts.show', $post->id) }}">
                            <!-- 画像を小さく表示 -->
                            <img src="{{ $post->image }}" alt="Post ID {{ $post->id }}" class="d-block mx-auto image-sm" style="width: 100px; height: auto;">
                        </a>
                    </td>
                    <td class="text-center">
                        @forelse($post->categoryPost as $category_post)
                            <span class="badge bg-secondary bg-opacity-50">
                                {{ $category_post->category->name }}
                            </span>
                        @empty
                            <div class="badge bg-dark text-wrap">Uncategorized</div>
                        @endforelse
                    </td>
                    <td class="text-center">{{ $post->title }}</td>
                    <td class="text-center">
                        <!-- ユーザー名をリンクにするがリンク先は#に設定 -->
                        <a href="#" class="text-dark text-decoration-none">
                            {{ $post->user->name }}
                        </a>
                    </td>
                    <td class="text-center">
                        {{ $post->created_at ? $post->created_at->format('Y-m-d H:i') : 'No Date' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="lead text-muted text-center">No Posts Found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    <!-- ページネーション -->
    <div class="d-flex justify-content-center">
        {{ $all_posts->links() }}
    </div>
</div>

@endsection

@section('styles')
<style>
    /* ヘッダーとデータ行の縦幅を指定 */
    .table th, .table td {
        height: 50px;
        vertical-align: middle;
    }
</style>
@endsection

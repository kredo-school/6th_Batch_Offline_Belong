@extends('layouts.app') 

@section('content')

<br>
<h1 class="text-center" style="font-size: 3rem; font-weight: bold;">Schedule</h1>
<br>

<!-- Post Table -->
<div class="col-md-9 col-sm-12 mx-auto">
    <table class="table table-hover align-middle border text-secondary w-100">
        <thead class="small table-primary text-secondary" >
            <tr>
                <th class="text-center">Posts</th> <!-- 画像列 -->
                <th class="text-center">CATEGORY</th>
                <th class="text-center">TITLE</th>
                <th class="text-center">OWNER</th>
                <th class="text-center">DATE</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @forelse($all_posts as $post)
                <tr>
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
                    <td>
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
<br>
<br>
<br>
<br>
<br>


@endsection

@section('styles')
<style>
    /* ヘッダーとデータ行の縦幅を指定 */
    .table th, .table td {
        height: 50px;
        vertical-align: middle;
    }

    /* テーブル内のコンテンツを中央揃え */
    .table th, .table td {
        text-align: center;
    }

    /* テーブル全体の中央揃え */
    .table {
        margin: 0 auto;
    }
</style>
@endsection
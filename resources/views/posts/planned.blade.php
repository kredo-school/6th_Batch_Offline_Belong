@extends('layouts.app')

@section('content')

<!-- Post Table -->
<div class="col-md-9 col-sm-12">
            <table class="table table-hover align-middle bg-white border text-secondary">
                <thead class="small table-success  text-secondary">
                    <tr>
                
                        <th>Posts</th> <!-- 画像列 -->
                        <th>CATEGORY</th>
                        <th>TITLE</th>
                        <th>OWNER</th>
                        <th>CREATED AT</th>
                        <th></th> <!-- 削除列を追加 -->
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
                            
                        </tr>

                    
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


@endsection


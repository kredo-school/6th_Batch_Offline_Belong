@extends('layouts.app')

@section('title','Admin: Users')

@section('content')
<style>
    .table th {
        background-color: #fdcdef; /* Change this to your desired background color */
    }
    .rounded-image {
        width: 50px; /* 幅を指定 */
        height: 50px; /* 高さを指定 */
        border-radius: 50%; /* 丸くする */
        object-fit: cover; /* 画像が枠に収まるように調整 */
        font-size: 2rem; /* アイコンのサイズを調整 */
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

        <!-- テーブルと検索フォームを横並びに配置 -->
        <div class="col-md-9 col-sm-12">
            <div class="d-flex justify-content-end mb-3">
                <form action="{{ route('admin.users.search') }}" style="width: 300px">
                    <input type="search" name="search" class="form-control form-control-sm" placeholder="Search for names">
                </form>
            </div>
            <!-- メッセージ表示 -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <table class="table table-hover align-middle bg-white border text-secondary mt-3">
                <thead class="small table-pink text-secondary">
                    <tr>
                        <th></th>
                        <th>NAME</th>
                        <th>EMAIL</th>
                        <th>AGE</th>
                        <th>GENDER</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($all_users as $user)
                        <tr class="table-pink">
                            <td class="text-center">
                                <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none">
                                    @if($user->profile_image)
                                        <img src="{{ $user->profile_image }}" alt="{{ $user->name }}" class="rounded-image text-center">
                                    @else
                                        <!-- デフォルト画像を表示 -->
                                        <i class="fa-solid fa-circle-user d-block text-center text-secondary" style="font-size: 3rem;"></i>
                                    @endif
                                </a>
                            </td>
                            <td>
                                <a href="#" class="text-decoration-none text-dark fw-bold">{{ $user->name }}</a>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->age }}</td>
                            <td>{{ $user->gender }}</td>
                            <td>
                                <div>
                                    <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#delete-user-{{ $user->id }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                                <!-- ユーザー削除の確認モーダル -->
                                <div class="modal fade" id="delete-user-{{ $user->id }}" tabindex="-1" aria-labelledby="delete-user-label" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="delete-user-label">Confirm Deletion</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete {{ $user->name }}? <br>This action cannot be undone.
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- ページネーション -->
    <div class="d-flex justify-content-center">
        {{ $all_users->links() }}
    </div>
</div>
<br>
<br>
<br>
@endsection

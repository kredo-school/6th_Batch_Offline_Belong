@extends('layouts.app')

@section('title','Admin: Users')

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
                            <td>
                                @if($user->avatar)
                                    <img src="{{ $user->avatar }}" alt="" class="rounded-circle d-block mx-auto avatar-md">
                                @else
                                    <!-- アイコンを大きくするためにクラスを変更 -->
                                    <i class="fa-solid fa-circle-user d-block text-center" style="font-size: 3rem;"></i>
                                @endif
                            </td>
                            <td>
                                <a href="#" class="text-decoration-none text-dark fw-bold">{{ $user->name }}</a>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->age }}</td>
                            <td>{{ $user->gender }}</td>
                            <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm" data-bs-toggle="dropdown">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </button>

                                        <div class="dropdown-menu">
                                            <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#delete-user-{{ $user->id }}">
                                                <i class="fa-solid fa-trash"></i> Delete {{ $user->name }}
                                            </button>
                                        </div>
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
                                                    Are you sure you want to delete {{ $user->name }}? This action cannot be undone.
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
@endsection

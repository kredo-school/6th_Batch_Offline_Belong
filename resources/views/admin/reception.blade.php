@extends('layouts.app')

@section('content')
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
                    <a href="{{ route('admin.notify') }}" class="list-group-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fa-solid fa-bell"></i> Notifications
                    </a>
                    <a href="{{ route('admin.receptions') }}" class="list-group-item {{ request()->routeIs('admin.receptions') ? 'active' : '' }}">
                        <i class="fa-solid fa-envelope"></i> Receptions
                    </a>
                </div>
            </div>
        @endif

        <div class="col-md-9 col-sm-12">
            <h1>Receptions</h1>

            <!-- Receptions Table -->
            <table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Message</th>
            <th>Date</th>
            <th>Actions</th> <!-- 追加: 削除ボタンの列 -->
        </tr>
    </thead>
    <tbody>
        @forelse($contacts as $contact)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->message }}</td>
                <td>{{ $contact->created_at->format('Y-m-d H:i') }}</td>
                <td>
                    <!-- 削除ボタンのフォーム -->
                    <form action="{{ route('admin.receptions.delete', $contact->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fa-solid fa-trash"></i> 削除
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center">受信メッセージはありません。</td>
            </tr>
        @endforelse
    </tbody>
</table>

        </div>
    </div>
</div>
@endsection

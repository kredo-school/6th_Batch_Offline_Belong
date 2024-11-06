@extends('layouts.app')

@section('title', 'Explore People')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 col-sm-12"> <!-- レスポンシブ対応 -->
            
            @auth
                @if(! request()->is('admin/*'))
                    <!-- サーチバーを中央に配置 -->
                    <div class="d-flex justify-content-center mb-5 mt-5">
                        <form action="{{ route('posts.search.user') }}" method="get" class="w-100">
                            <input type="search" name="query" class="form-control form-control-lg" placeholder="Search for users..." value="{{ request()->query('query') }}">
                        </form>
                    </div>
                @endif
            @endauth

            <!-- 検索結果の表示 -->
            <p class="h4 text-muted mb-4 text-center">Search results for "<span class="fw-bold">{{ $query }}</span>"</p>

            @forelse($users as $user)
                <div class="row align-items-center mb-4 p-3 rounded border shadow-sm">
                    <div class="col-auto">
                        <a href="#">
                            <!-- アイコン表示 -->
                            @if($user->avatar)
                                <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                            @else
                                <i class="fa-solid fa-circle-user text-secondary" style="font-size: 2rem;"></i>
                            @endif
                        </a>
                    </div>
                    <div class="col ms-3">
                        <a href="#" class="text-decoration-none text-dark">
                            <p class="h5 mb-0">{{ $user->name }}</p>
                        </a>
                    </div>
                </div>
            @empty
                <p class="lead text-muted text-center">No users found.</p>
            @endforelse
        </div>
    </div>
@endsection

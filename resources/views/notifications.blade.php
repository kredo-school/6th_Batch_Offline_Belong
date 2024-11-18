@extends('layouts.app')

@section('title', 'Notifications')

@section('content')
<div class="container">
    <h1 class="mt-5">Notifications</h1>

    @forelse ($notifications as $notification)
        <div class="alert {{ $notification->read_at ? 'alert-secondary' : 'alert-info' }}">
            <!-- 未読のとき「New!」を表示 -->
            @if (!$notification->read_at)
                <span class="badge bg-success">New!</span>
            @endif

            <!-- 通知メッセージ -->
            <p>
                <!-- 投稿がリジェクトされた場合の通知メッセージ -->
                <strong>{{ $notification->data['message'] }}</strong>

                <!-- 投稿タイトルリンクの表示 -->
                @if (isset($notification->data['post_id']))
                    <a href="{{ route('approve.show', $notification->data['post_id']) }}" class="text-primary text-decoration-none">
                        "{{ $notification->data['title'] ?? 'Untitled Post' }}"
                    </a>
                @endif

                <br>
                <!-- リジェクト理由 -->
                <strong>Reason:</strong> {{ $notification->data['reason'] ?? 'No reason provided.' }}
                <br>
            </p>

            <!-- 通知の作成時間 -->
            <span class="text-muted"> - {{ $notification->created_at->diffForHumans() }}</span>
        </div>
    @empty
        <p class="text-center">You have no notifications.</p>
    @endforelse
</div>
<br><br><br>
@endsection

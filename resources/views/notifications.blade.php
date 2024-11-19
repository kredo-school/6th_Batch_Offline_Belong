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
                <strong>
                    @if (isset($notification->data['type']))
                        @if ($notification->data['type'] === 'booking')
                            <!-- 予約通知の場合 -->
                            <a href="{{ $notification->data['booker_profile_url'] ?? '#' }}" class="text-primary text-decoration-none">
                                {{ $notification->data['booker_name'] ?? 'Someone' }}
                            </a> has joined your post:
                            <a href="{{ $notification->data['post_url'] ?? '#' }}" class="text-primary text-decoration-none">
                                "{{ $notification->data['post_title'] ?? 'Unknown Post' }}"
                            </a>.
                        @elseif ($notification->data['type'] === 'rejection')
                            <!-- 投稿リジェクト通知の場合 -->
                            {!! str_replace($notification->data['title'] ?? 'Untitled Post',
                                '<a href="' . route('approve.show', $notification->data['post_id'] ?? '#') . '" class="text-primary text-decoration-none">' . ($notification->data['title'] ?? 'Untitled Post') . '</a>',
                                $notification->data['message'] ?? 'No details provided.') !!}
                        @elseif ($notification->data['type'] === 'comment')
                            <!-- コメント通知の場合 -->
                            <a href="{{ $notification->data['commenter_profile_url'] ?? '#' }}" class="text-primary text-decoration-none">
                                {{ $notification->data['commenter_name'] ?? 'Someone' }}
                            </a> commented on your post:
                            <a href="{{ $notification->data['post_url'] ?? '#' }}" class="text-primary text-decoration-none">
                                "{{ $notification->data['post_title'] ?? 'Unknown Post' }}"
                            </a>.
                            <blockquote class="blockquote">
                                "{{ $notification->data['body'] ?? 'No comment text provided.' }}"
                            </blockquote>
                        @else
                            <!-- その他の通知 -->
                            {{ $notification->data['message'] ?? 'No details available.' }}
                        @endif
                    @else
                        {{ $notification->data['message'] ?? 'No details available.' }}
                    @endif
                </strong>

                <br>

                <!-- リジェクト理由（該当する場合のみ） -->
                @if (isset($notification->data['reason']))
                    <strong>Reason:</strong> {{ $notification->data['reason'] ?? 'No reason provided.' }}
                    <br>
                @endif
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

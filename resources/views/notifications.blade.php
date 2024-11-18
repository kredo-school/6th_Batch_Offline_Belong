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
                <!-- 通知メッセージの表示 -->
                <strong>
                    <!-- メッセージ内のタイトル部分をリンク化 -->
                    @if (isset($notification->data['title']))
                        {!! str_replace($notification->data['title'],
                            '<a href="' . route('approve.show', $notification->data['post_id']) . '" class="text-primary text-decoration-none">' . $notification->data['title'] . '</a>',
                            $notification->data['message']) !!}
                    @else
                        {{ $notification->data['message'] }}
                    @endif
                </strong>

                <br>

                <!-- リジェクト理由 -->
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

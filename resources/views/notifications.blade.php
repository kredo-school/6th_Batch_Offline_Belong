<!-- resources/views/notifications.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mt-5">Notifications</h1>
    @foreach ($notifications as $notification)
        <div class="alert alert-info">
            {{ $notification->data['message'] }}
            <span class="text-muted"> - {{ $notification->created_at->diffForHumans() }}</span>
        </div>
    @endforeach
</div>
<br>
<br>
<br>
@endsection

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
                    <!-- Notification Link -->
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
            <h1>Send Notification</h1>

            <!-- Success Message -->
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('admin.notify.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="target">Send to</label>
                    <select name="target" id="target" class="form-control" required>
                        <option value="all" {{ old('target', 'all') == 'all' ? 'selected' : '' }}>All Users</option>
                        <option value="single" {{ old('target') == 'single' ? 'selected' : '' }}>Single User</option>
                    </select>
                </div>

                <!-- Display user selection only when "single" is selected -->
                <div class="form-group" id="user_select_group" style="display: {{ old('target') == 'single' ? 'block' : 'none' }};">
                    <label for="user_id">Select User</label>
                    <select name="user_id" id="user_id" class="form-control">
                        <option value="">Select a user</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea name="message" id="message" class="form-control" rows="3" required>{{ old('message') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Send Notification</button>
            </form>
        </div>
    </div>
</div>

<script>
    // JavaScript to toggle user selection based on target
    document.getElementById('target').addEventListener('change', function() {
        var target = this.value;
        var userSelectGroup = document.getElementById('user_select_group');

        // If 'single' is selected, show user select group, else hide it
        if (target === 'single') {
            userSelectGroup.style.display = 'block';
        } else {
            userSelectGroup.style.display = 'none';
        }
    });

    // Trigger the change event to make sure the form displays correctly after page load
    document.getElementById('target').dispatchEvent(new Event('change'));
</script>

@endsection

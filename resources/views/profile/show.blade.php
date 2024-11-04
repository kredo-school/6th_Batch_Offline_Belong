@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Profile</h1>

    @if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="age">Age</label>
            <input type="number" name="age" id="age" class="form-control" value="{{ old('age', $profile->age ?? '') }}">
        </div>

        <div class="form-group">
            <label for="gender">Gender</label>
            <input type="text" name="gender" id="gender" class="form-control" value="{{ old('gender', $profile->gender ?? '') }}">
        </div>

        <div class="form-group">
            <label for="bio">Bio</label>
            <textarea name="bio" id="bio" class="form-control">{{ old('bio', $profile->bio ?? '') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Edit Profile</button>
    </form>
</div>
@endsection

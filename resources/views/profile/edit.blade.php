@extends('layouts.app')

@section('content')
    <div class="container">
   
        <div class="row justify-content-center ">
            <div class="col-7">
                <form action="{{route('profile.update',$user->id)}}" method="post" enctype="multipart/form-data" class="p-5 shadow">
                    @csrf
                    @method('patch')
                    <div class="row mb-3">
                        <div class="col text-center">
                            @if ($user->profile_image)
                                <img src="{{ $user->profile_image }}" alt="">
                            @else
                                <i class="fa-solid fa-circle-user fa-10x"></i>
                            @endif
                        </div>
                        <div class="col-auto align-self-center">
                            <input type="file" name="profile_image" class="form-control">
                            <div class="form-text text-danger small">
                                Acceptable formats: jpeg, jpg, png, gif (1MB max)
                            </div>
                        </div>

                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">Name</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold">Email</label>
                        <input type="text" name="email" id="email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="bio" class="form-label fw-bold">Bio</label>
                        <textarea name="bio" id="bio"  rows="3" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-warning px-5">Save Profile</button>
                </form>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>

    </div>
@endsection

<!-- CSSのスタイル定義 -->
<style>
    .rounded-image {
        width: 250px;
        height: 250px;
        border-radius: 50%;
        /* 画像を丸くする */
        object-fit: cover;
        /* 画像をコンテナにフィットさせる */
    }
</style>

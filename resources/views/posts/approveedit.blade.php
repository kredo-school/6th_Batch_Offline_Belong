@extends('layouts.app')

@section('title', 'Approve Edit Post')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="background-color: #fdcdef;">
                        <div class="d-flex align-items-center justify-content-between">
                            <a href="{{ route('home') }}" style="color: black;">
                                <i class="fa-solid fa-chevron-left"></i>
                            </a>
                            <h2 class="text-black fw-bold m-0 mx-auto">Edit Post</h2>
                            <div style="width: 24px;"></div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('posts.approveedit.update', $post->id) }}" enctype="multipart/form-data"> <!-- 修正 -->
                            @csrf
                            @method('POST') <!-- PUTメソッドを指定 -->

                            <!-- Category -->
                            <div class="mb-3">
                                <label class="form-label d-block fw-bold">Category <span class="text-muted fw-normal">(Select one)</span></label>
                                
                                <div class="d-flex flex-wrap">
                                    @foreach($all_categories as $category)
                                        <div class="form-check form-check-inline">
                                            <!-- チェックボックスに変更（選択されたカテゴリがある場合にチェックを付ける） -->
                                            <input type="checkbox" name="category[]" id="category_{{ $category->id }}"
                                                value="{{ $category->id }}" class="form-check-input"
                                                {{ in_array($category->id, $selected_categories) ? 'checked' : '' }}>

                                            <label for="category_{{ $category->id }}" class="form-check-label">
                                                {{ $category->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- バリデーションエラーメッセージ -->
                                @error('category')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Title -->
                            <div class="mb-3 row">
                                <label for="title" class="col-md-4 col-form-label">Title :</label>
                                <div class="col-md-8">
                                    <input id="title" type="text" class="form-control" name="title" value="{{ old('title', $post->title) }}" required>
                                </div>
                            </div>

                            <!-- Date -->
                            <div class="mb-3 row">
                                <label for="date" class="col-md-4 col-form-label">Date :</label>
                                <div class="col-md-8">
                                    <input id="date" type="datetime-local" class="form-control" name="date" value="{{ old('date', $post->date) }}" required>
                                </div>
                            </div>

                            <!-- Reservation Due Date -->
                            <div class="mb-3 row">
                                <label for="reservation_due_date" class="col-md-4 col-form-label">Reservation due date :</label>
                                <div class="col-md-8">
                                    <input id="reservation_due_date" type="datetime-local" class="form-control" name="reservation_due_date" value="{{ old('reservation_due_date', $post->reservation_due_date) }}" required>
                                </div>
                            </div>

                            <!-- Place -->
                            <div class="mb-3 row">
                                <label for="place" class="col-md-4 col-form-label">Place :</label>
                                <div class="col-md-8">
                                    <input id="place" type="text" class="form-control" name="place" value="{{ old('place', $post->place) }}" required>
                                </div>
                            </div>

                            <!-- Planned Number of People -->
                            <div class="mb-3 row">
                                <label for="planned_number_of_people" class="col-md-4 col-form-label">Planned number of people :</label>
                                <div class="col-md-8">
                                    <input id="planned_number_of_people" type="number" class="form-control" name="planned_number_of_people" value="{{ old('planned_number_of_people', $post->planned_number_of_people) }}">
                                </div>
                            </div>

                            <!-- Participation Fee -->
                            <div class="mb-3 row">
                                <label for="participation_fee" class="col-md-4 col-form-label">Participation fee :</label>
                                <div class="col-md-8">
                                    <input id="participation_fee" type="text" class="form-control" name="participation_fee" value="{{ old('participation_fee', $post->participation_fee) }}">
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="mb-3 row">
                                <label for="description" class="col-md-4 col-form-label">Description :</label>
                                <div class="col-md-8">
                                    <textarea id="description" class="form-control" name="description" rows="3">{{ old('description', $post->description) }}</textarea>
                                </div>
                            </div>

                            <!-- Image Upload -->
                            <div class="mb-3 row">
                                <label for="image" class="col-md-4 col-form-label">Image :</label>
                                <div class="col-md-8">
                                    <input id="image" type="file" class="form-control" name="image">
                                    @if ($post->image)
                                        <div class="mt-2">
                                            <img src="{{ asset('storage/' . $post->image) }}" alt="Current image" class="img-thumbnail" style="max-width: 200px;">
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <hr>

                            <!-- Buttons -->
                            <div class="mb-3 row">
                                <div class="col-md-6 text-center">
                                    <button type="reset" class="btn btn-light" style="border: 1px solid #000;">Cancel</button>
                                </div>
                                <div class="col-md-6 text-center">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
@endsection

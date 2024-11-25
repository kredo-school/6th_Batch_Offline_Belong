@extends('layouts.app')

@section('content')
<!-- Include the font-awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />

<!-- Custom style to set table header background color -->
<style>
    .table th {
        background-color: #fdcdef; /* Change this to your desired background color */
    }
</style>

<div class="container mt-5">
    <h2>Your Booked Posts</h2>

    @if (session('success'))
        <div class="alert alert-danger">{{ session('success') }}</div>
    @endif

    @if($bookedPosts->isEmpty())
        <p>No upcoming bookings.</p>
    @else
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>Post</th>
                    <th>Title</th>
                    <th>Created By</th>
                    <th>Place</th>
                    <th>Fee</th>
                    <th>Date</th>
                    <th>Cancel</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookedPosts as $book) <!-- This $book is defined in the loop -->
                    <tr>
                        <td>
                            <a href="{{ route('posts.show', $book->post->id) }}">
                                <img src="{{ $book->post->image }}" alt="{{ $book->post->title }}" style="width: 100px; height: auto;">
                            </a>
                        </td>
                        <td>{{ $book->post->title }}</td>
                        <td>{{ $book->post->user->name }}</td>
                        <td>{{ $book->post->place }}</td>
                        <td>{{ $book->post->participation_fee }}</td>
                        <td>{{ $book->post->date }}</td>
                        <td>
                            <button type="button" class="btn p-0" style="font-size: 36px;" data-bs-toggle="modal" data-bs-target="#delete-post-{{ $book->post->id }}">
                                <i class="fa-sharp fa-solid fa-trash text-danger"></i>
                            </button>
                        </td>
                    </tr>

                    <!-- Delete Modal -->
                    <div class="modal fade" id="delete-post-{{ $book->post->id }}" tabindex="-1" aria-labelledby="deletePostLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-danger">
                                <div class="modal-header border-danger">
                                    <h3 class="h5 modal-title text-danger" id="deletePostLabel">
                                        <i class="fa-solid fa-circle-exclamation"></i> Cancel Event
                                    </h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to cancel this event?</p>
                                    <div class="mt-3">
                                        @if ($book->post->image)
                                            <img src="{{ $book->post->image }}" alt="Post ID {{ $book->post->id }}" class="w-100 mb-3">
                                        @endif
                                        <div class="mt-3">
                                            <h4 class="fw-bold">Title: {{ $book->post->title }}</h4>
                                            <strong>Date:</strong> {{ date('M d, Y', strtotime($book->post->date)) }}<br>
                                            <strong>Reservation Due Date:</strong> {{ date('M d, Y', strtotime($book->post->reservation_due_date)) }}<br>
                                            <strong>Place:</strong> {{ $book->post->place }}<br>
                                            <strong>Participation Fee:</strong> {{ $book->post->participation_fee }}<br>
                                            <strong>Planned Number of People:</strong> {{ $book->post->planned_number_of_people }}<br>
                                            <p class="fw-light">{{ $book->post->description }}</p>
                                            <p class="text-uppercase text-muted xsmall">{{ date('M d, Y', strtotime($book->post->created_at)) }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer border-0">
                                    <form action="{{ route('posts.cancel', $book->post->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')

                                        <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-danger btn-sm">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
<br>
<br>
<br>
@endsection

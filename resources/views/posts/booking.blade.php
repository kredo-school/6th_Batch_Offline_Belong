@extends('layouts.app')

@section('content')
<div class="container mt-5 mb-5 d-flex flex-column align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="text-center" style="background-color: #fdcdef; padding: 10px; border-radius: 5px;">
        <h2 class="mb-0" style="font-size: 2rem;">Booking</h2>
    </div>
    
    <div class="d-flex justify-content-center mt-4">
        <div class="card p-0" style="width: 900px; background-color: #fdcdef;">
            <div class="row g-0">
                <div class="col-md-6 text-center" style="background-color: #fdcdef;">
                    @if ($post->image)
                        <img src="{{ $post->image }}" alt="Post ID {{ $post->id }}" class="mb-3 mt-5" style="border-radius: 50%; object-fit: cover; width: 220px; height: 220px;">
                    @endif
                </div>

                <div class="col-md-6" style="background-color: #ffffff;">
                    <div style="padding: 30px;">
                        <h4 class="text-start">Organizer</h4>
                        <p class="text-start" style="border: 1px solid #ccc; padding: 10px; border-radius: 5px;">{{ $post->user->name }}</p>
                        <h4 class="text-start">Date</h4>
                        <p class="text-start" style="border: 1px solid #ccc; padding: 10px; border-radius: 5px;">{{ $post->date }}</p>
                        <h4 class="text-start">Place</h4>
                        <p class="text-start" style="border: 1px solid #ccc; padding: 10px; border-radius: 5px;">{{ $post->place }}</p>
                        <h4 class="text-start">Participation Fee</h4>
                        <p class="text-start" style="border: 1px solid #ccc; padding: 10px; border-radius: 5px;">¥{{ number_format($post->participation_fee) }}</p>
                        <h4 class="text-start">Planned Number of People</h4>
                        <p class="text-start" style="border: 1px solid #ccc; padding: 10px; border-radius: 5px;">{{ $post->planned_number_of_people }} people</p>
                        <h4 class="text-start">Information</h4>
                        <p class="text-start" style="border: 1px solid #ccc; padding: 10px; border-radius: 5px;">{{ $post->description }}</p>
                        
                        <div class="d-flex justify-content-center mt-4">
                            <div class="d-flex justify-content-between" style="width: 100%; max-width: 500px;">
                                <form action="{{ route('posts.show', $post->id) }}" method="GET" style="flex: 1; margin-right: 5px;">
                                    <button type="submit" class="btn btn-outline-secondary" style="flex: 1; height: 50px; display: flex; align-items: center; justify-content: center; width: 100%;">Back</button>
                                </form>
                                <form action="{{ route('bookings.store', $post->id) }}" method="POST" style="flex: 1; margin-left: 5px;">
                                    @csrf
                                    <button type="submit" class="btn btn-primary" style="flex: 1; height: 50px; display: flex; align-items: center; justify-content: center; width: 100%;">Join</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<br>
<br>
@endsection

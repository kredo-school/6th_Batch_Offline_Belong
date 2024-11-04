<div class="modal fade" id="usersModal{{ $post->id }}" tabindex="-1" aria-labelledby="usersModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="usersModalLabel">Participants</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if($post->books->isNotEmpty())
                    <ul class="list-group">
                        @foreach($post->books as $book)
                            <li class="list-group-item d-flex align-items-center">
                                <div class="me-2">
                                    @if($book->user->avatar)
                                        <img src="{{ $book->user->avatar }}" alt="{{ $book->user->name }}" class="rounded-circle" style="width: 30px; height: 30px;">
                                    @else
                                        <i class="fa-solid fa-circle-user text-secondary" style="font-size: 30px;"></i>
                                    @endif
                                </div>
                                <span>{{ $book->user->name }}</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>No users have joined this post yet.</p>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

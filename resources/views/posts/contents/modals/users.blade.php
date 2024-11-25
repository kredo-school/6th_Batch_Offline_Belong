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
                                    <a href="{{ route('profile.show', $book->user->id) }}" style="text-decoration: none">
                                        @if ($book->user->profile_image)
                                            <img src="{{ $book->user->profile_image }}" alt="Profile Image" class="profile-icon">
                                        @else
                                            <i class="fa-solid fa-circle-user profile-icon"></i>
                                        @endif
                                    </a>
                                </div>
                                <span><a href="{{ route('profile.show', $book->user->id) }}" class="text-decoration-none">{{ $book->user->name }}</a></span>
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
<style>
    .profile-icon {
        width: 80px; /* 幅を統一 */
        height: 80px; /* 高さを統一 */
        border-radius: 50%; /* 丸くする */
        object-fit: cover; /* 画像の比率を保持しながら枠に収める */
        font-size: 80px; /* アイコンフォントサイズを画像サイズと一致させる */
        display: block; /* アイコンや画像が中央に揃う */
    }
</style>

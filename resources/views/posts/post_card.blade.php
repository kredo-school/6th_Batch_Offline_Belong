<style>
    .rounded-image {
        width: 50px; /* 幅を指定 */
        height: 50px; /* 高さを指定 */
        border-radius: 50%; /* 丸くする */
        object-fit: cover; /* 画像が枠に収まるように調整 */
        font-size: 2rem; /* アイコンのサイズを調整 */
    }
</style>
<div class="card post-card border-0">
    <!-- Card Header -->
    <div class="card-header bg-white py-3">
        <div class="row align-items-center">
            <div class="col-auto">
                <a href="{{ route('profile.show', $post->user->id) }}" class="text-decoration-none">
                    @if($post->user->profile_image)
                        <img src="{{ $post->user->profile_image }}" alt="{{ $post->user->name }}" class="rounded-image">
                    @else
                        <!-- デフォルト画像を表示 -->
                        <i class="fa-solid fa-circle-user d-block text-center text-secondary" style="font-size: 3rem;"></i>
                    @endif
                </a>
            </div>

            <div class="col ps-0">
                <a href="#" class="text-decoration-none text-dark">{{ $post->user->name }}</a>
            </div>
            <div class="col-auto">
                <button class="btn btn-sm shadow-none" data-bs-toggle="dropdown">
                    <i class="fa-solid fa-ellipsis"></i>
                </button>
                <div class="dropdown-menu">
                    <a href="{{ route('posts.edit', $post->id) }}" class="dropdown-item">
                        <i class="fa-regular fa-pen-to-square"></i> Edit
                    </a>
                    <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#delete-post-{{ $post->id }}">
                        <i class="fa-regular fa-trash-can"></i> Delete
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Post Image -->
    @if ($post->image)
        <a href="{{ route('posts.show', $post->id) }}">
            <img src="{{ $post->image }}" alt="Post ID {{ $post->id }}" class="w-100 mb-3">
        </a>
    @endif

    <!-- Post Details -->
    <div class="mt-3">
        <h4 class="fw-bold">Title: {{ $post->title }}</h4>
        <div class="col text-start">
            @foreach($post->categories as $category)
                <span class="badge bg-secondary bg-opacity-50">{{ $category->name }}</span>
            @endforeach
        </div>
        <strong>Date:</strong> {{ date('M d, Y', strtotime($post->date)) }}<br>
        <strong>Reservation Due Date:</strong> {{ date('M d, Y', strtotime($post->reservation_due_date)) }}<br>
        <strong>Place:</strong> {{ $post->place }}<br>
        <strong>Participation Fee:</strong> {{ $post->participation_fee }}<br>
        <strong>Planned Number of People:</strong> {{ $post->planned_number_of_people }}<br>
        <strong>Description:</strong> {{ $post->description }}
    </div>

    <!-- Action Buttons -->
    <div class="text-end">
                    <a href="#" class="btn btn-sm shadow-none p-0" data-bs-toggle="modal" data-bs-target="#usersModal{{ $post->id }}">
                        <i class="fa-solid fa-user icon-lg"></i>
                        <span class="icon-count">{{ $post->books->count() }}</span>
                    </a>

                    @if($post->isBooked())
                    <span class="btn btn-sm shadow-none p-0 text-muted" title="Already Booked">
                        <i class="fa-solid fa-heart text-danger icon-lg"></i>
                    </span>
                    @else
                    <a href="{{ route('bookings.show', $post->id) }}" class="btn btn-sm p-0" title="Book this Post">
                        <i class="fa-regular fa-heart text-danger icon-lg"></i>
                    </a>
                    @endif
    </div>

    <hr>

    <!-- Comment Section -->
    <form action="{{ route('comment.store', $post->id) }}" method="post">
        @csrf
        <div class="input-group mb-3">
            <textarea name="comment_body{{ $post->id }}" rows="1" class="form-control form-control-sm" placeholder="Add a comment..." required>{{ old('comment_body' . $post->id) }}</textarea>
            <button class="btn btn-outline-secondary btn-sm">Post</button>
        </div>
        @error('comment_body' . $post->id)
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </form>

    @if($post->comments && $post->comments->isNotEmpty())
        <hr>
        <ul class="list-group">
            @foreach($post->comments as $comment)
            <li class="list-group-item border-0 p-2">
                <div class="d-flex align-items-start">
                    <!-- ユーザープロフィールアイコン -->
                    <a href="{{ route('profile.show', $comment->user->id) }}" class="me-2" style="text-decoration: none">
                        @if ($comment->user->profile_image)
                            <img src="{{ $comment->user->profile_image }}" alt="Profile Image" class="rounded-circle" style="width: 32px; height: 32px; object-fit: cover;">
                        @else
                            <i class="fa-solid fa-circle-user text-secondary" style="font-size: 32px;"></i>
                        @endif
                    </a>

                    <!-- ユーザーネームとコメント -->
                    <div>
                        <a href="{{ route('profile.show', $comment->user->id) }}" class="text-decoration-none text-dark fw-bold me-2">{{ $comment->user->name }}</a>
                        <span class="text-muted small">{{ $comment->body }}</span>

                        <!-- 投稿日時 -->
                        <div class="text-muted small mt-1">
                            {{ date('M d, Y', strtotime($comment->created_at)) }}
                        </div>
                    </div>
                </div>

                <!-- アクションボタン -->
                @if(Auth::user()->id === $comment->user->id)
                    <div class="text-end mt-1">
                        <form action="{{ route('comment.destroy', $comment->id) }}" method="post" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="border-0 bg-transparent text-danger p-0 small">
                                <i class="fa-sharp fa-solid fa-trash text-danger"></i>
                            </button>
                        </form>
                    </div>
                @endif
            </li>
            @endforeach
        </ul>
    @endif
</div>

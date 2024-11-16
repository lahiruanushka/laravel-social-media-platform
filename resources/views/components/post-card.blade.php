<div class="card shadow-sm mb-4">
    <div class="card-header bg-white border-0 py-3">
        <div class="d-flex align-items-center">
            <img src="{{ $post->user->profile->image ? asset($post->user->profile->image) : asset('images/Blank-Profile-Picture.webp') }}"
                 class="rounded-circle me-3"
                 style="width: 40px; height: 40px;"
                 alt="Profile Picture">
            <div>
                <a class="dropdown-item" href="{{ route('profile.show', ['user' => $post->user->id]) }}">
                    <h6 class="mb-0">{{ $post->user->name }}</h6>
                </a>
                <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
            </div>
        </div>
    </div>
    @if ($post->image)
    <a href="{{ route('posts.show', ['post' => $post->id]) }}" class="text-decoration-none">
        <img src="{{ asset($post->image) }}" alt="{{ $post->caption }}" class="card-img-top">
    </a>
    @endif
    <div class="card-body">
        <p class="card-text">{{ $post->caption }}</p>
        <div class="d-flex justify-content-between align-items-center">
            <div class="btn-group">
                <button type="button" class="btn btn-sm btn-outline-secondary like-button"
                        data-post-id="{{ $post->id }}">
                    <i class="bi bi-heart{{ $post->isLikedBy(auth()->user()) ? '-fill' : '' }}"></i>
                    Like <span id="likes-count-{{ $post->id }}">{{ $post->likes()->count() }}</span>
                </button>
                <button type="button" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-chat"></i> Comment
                </button>
                <button type="button" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-share"></i> Share
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.like-button').forEach(button => {
        button.addEventListener('click', function () {
            const postId = this.getAttribute('data-post-id');
            const likeIcon = this.querySelector('i');
            const likeCountSpan = document.getElementById(`likes-count-${postId}`);

            fetch(`/posts/${postId}/like`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                // Update like button icon
                likeIcon.classList.toggle('bi-heart-fill', data.liked);
                likeIcon.classList.toggle('bi-heart', !data.liked);

                // Update likes count
                likeCountSpan.textContent = data.likes_count;
            })
            .catch(error => console.error('Error:', error));
        });
    });
</script>

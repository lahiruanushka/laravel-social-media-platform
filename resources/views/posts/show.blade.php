@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm">
                <div class="row g-0">
                    <!-- Post Image Section -->
                    <div class="col-lg-8 position-relative">
                        @if ($post->image)
                            <img src="{{ asset($post->image) }}"
                                 class="img-fluid w-100 h-100 object-fit-cover"
                                 style="max-height: 600px;"
                                 alt="{{ $post->caption }}">
                        @endif

                        <!-- Post Actions Overlay -->
                        <div class="position-absolute bottom-0 start-0 w-100 p-3 bg-gradient-dark bg-opacity-50">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <button class="btn text-white me-3">
                                        <i class="far fa-heart fa-lg"></i>
                                    </button>
                                    <button class="btn text-white me-3">
                                        <i class="far fa-comment fa-lg"></i>
                                    </button>
                                    <button class="btn text-white">
                                        <i class="far fa-paper-plane fa-lg"></i>
                                    </button>
                                </div>
                                <button class="btn text-white">
                                    <i class="far fa-bookmark fa-lg"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Post Details Section -->
                    <div class="col-lg-4">
                        <div class="p-4">
                            <!-- User Info & Actions -->
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <img src="{{ $post->user->profile->image ? asset($post->user->profile->image) : asset('images/Blank-Profile-Picture.webp') }}"
                                             alt="Profile Picture"
                                             class="rounded-circle object-fit-cover"
                                             style="width: 44px; height: 44px;">
                                    </div>
                                    <div>
                                        <a href="{{ route('profile.show', $post->user->id) }}"
                                           class="text-decoration-none">
                                            <h6 class="mb-0 fw-bold text-dark">{{ $post->user->username }}</h6>
                                        </a>
                                        <small class="text-muted">{{ $post->location ?? 'No location' }}</small>
                                    </div>
                                </div>

                                <div>
                                 @if(Auth::id() !== $post->user_id)
    @if(Auth::user()->following->contains($post->user_id))
        <form action="{{ route('unfollow', $post->user_id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-secondary rounded-pill px-3">
                <i class="fas fa-user-minus me-2"></i>Unfollow
            </button>
        </form>
    @else
        <form action="{{ route('follow', $post->user_id) }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-primary rounded-pill px-3">
                <i class="fas fa-user-plus me-2"></i>Follow
            </button>
        </form>
    @endif
@endif

                                    @if(Auth::id() === $post->user_id)
                                        <div class="dropdown">
                                            <button class="btn btn-link text-dark" type="button" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('posts.edit', $post->id) }}">
                                                        <i class="fas fa-edit me-2"></i>Edit Post
                                                    </a>
                                                </li>
                                                <li>
                                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger">
                                                            <i class="fas fa-trash-alt me-2"></i>Delete Post
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Caption -->
                            <div class="mb-4">
                                <p class="mb-2">{{ $post->caption }}</p>
                                <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                            </div>

                            <!-- Comments Section -->
                            <div class="border-top pt-4">
                                <h6 class="mb-3">Comments</h6>
                                <div class="comments-container" style="max-height: 300px; overflow-y: auto;">
                                    <!-- Example Comment -->
                                    <div class="d-flex mb-3">
                                        <img src="{{ asset('images/Blank-Profile-Picture.webp') }}"
                                             alt="Commenter"
                                             class="rounded-circle me-2"
                                             style="width: 32px; height: 32px;">
                                        <div class="flex-grow-1">
                                            <p class="mb-0"><strong>username</strong> This is a comment</p>
                                            <small class="text-muted">2h ago</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Add Comment -->
                                <div class="mt-3">
                                    <form class="d-flex">
                                        <input type="text"
                                               class="form-control rounded-pill me-2"
                                               placeholder="Add a comment...">
                                        <button type="submit" class="btn btn-primary rounded-pill px-3">
                                            <i class="fas fa-paper-plane"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<style>
    .bg-gradient-dark {
        background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.7) 100%);
    }

    .object-fit-cover {
        object-fit: cover;
    }

    /* Custom scrollbar for comments */
    .comments-container::-webkit-scrollbar {
        width: 5px;
    }

    .comments-container::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    .comments-container::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 5px;
    }

    .comments-container::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>

@endsection

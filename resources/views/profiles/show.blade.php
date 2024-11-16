@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Profile Header -->
    <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
        <div class="card-body p-4">
            <div class="row align-items-center">
                <!-- Profile Image Section -->
                <div class="col-lg-3 text-center">
                    <div class="position-relative d-inline-block">
                        <img
                            src="{{ $user->profile->image ? asset($user->profile->image) : asset('images/Blank-Profile-Picture.webp') }}"
                            alt="{{ $user->username }}'s avatar"
                            class="rounded-circle border border-2 border-white shadow"
                            style="width: 180px; height: 180px; object-fit: cover;">

                        @if (auth()->user() && auth()->user()->id === $user->id)
                        <a href="{{ route('profile.edit', ['user' => Auth::user()->id]) }}"
   class="position-absolute bottom-0 end-0 bg-primary rounded-circle p-2 shadow-sm">
    <i class="fas fa-pencil-alt text-white"></i>
</a>

                        @endif
                    </div>
                </div>

                <!-- Profile Info Section -->
                <div class="col-lg-9">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3">
                        <div>
                            <h1 class="display-6 fw-bold mb-1">{{ $user->username }}</h1>
                            <h2 class="h5 text-muted mb-2">{{ $user->profile->title }}</h2>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-2 mb-3 mb-md-0">
                            @if (auth()->user() && auth()->user()->id === $user->id)
                                <a href="{{ route('posts.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus-circle me-2"></i>New Post
                                </a>
                            @elseif (auth()->user())
                                @if (auth()->user()->following->contains($user->id))
                                    <form action="{{ route('unfollow', $user) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger">
                                            <i class="fas fa-user-minus me-2"></i>Unfollow
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('follow', $user) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-user-plus me-2"></i>Follow
                                        </button>
                                    </form>
                                @endif
                            @endif
                        </div>
                    </div>

                    <!-- Stats Cards -->
                    <div class="row g-3 mb-4">
                        <div class="col-4">
                            <div class="card border-0 bg-light">
                                <div class="card-body text-center py-3">
                                    <h3 class="h2 fw-bold mb-1">{{ $postCount }}</h3>
                                    <span class="text-muted">Posts</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card border-0 bg-light">
                                <div class="card-body text-center py-3">
                                    <h3 class="h2 fw-bold mb-1">{{ $followersCount }}</h3>
                                    <span class="text-muted">Followers</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card border-0 bg-light">
                                <div class="card-body text-center py-3">
                                    <h3 class="h2 fw-bold mb-1">{{ $followingCount }}</h3>
                                    <span class="text-muted">Following</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bio Section -->
                    <div>
                        <p class="mb-2 lead">{{ $user->profile->description }}</p>
                        @if ($user->profile->url)
                            <a href="{{ $user->profile->url }}" target="_blank"
                               class="text-decoration-none d-inline-flex align-items-center">
                                <i class="fas fa-link me-2 text-primary"></i>
                                <span class="text-break">{{ $user->profile->url }}</span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Posts Grid -->
    <div class="row g-4">
        @foreach ($user->posts as $post)
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 post-card">
                    <a href="/p/{{ $post->id }}" class="text-decoration-none">
                        @if ($post->image)
                            <div class="position-relative">
                                <img src="{{ asset($post->image) }}"
                                     class="card-img-top"
                                     alt="{{ $post->caption }}"
                                     style="height: 300px; object-fit: cover;">
                                <div class="post-overlay">
                                    <div class="d-flex gap-4 text-white">
                                        <div>
                                            <i class="fas fa-heart"></i>
                                            <span class="ms-2">{{ $post->likes_count ?? 0 }}</span>
                                        </div>
                                        <div>
                                            <i class="fas fa-comment"></i>
                                            <span class="ms-2">{{ $post->comments_count ?? 0 }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>

<style>
.post-card {
    transition: transform 0.2s ease-in-out;
    cursor: pointer;
    border-radius: 12px;
    overflow: hidden;
}

.post-card:hover {
    transform: translateY(-5px);
}

.post-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.post-card:hover .post-overlay {
    opacity: 1;
}

.card {
    border-radius: 12px;
}

.btn {
    padding: 0.5rem 1.5rem;
    border-radius: 8px;
    font-weight: 500;
}

.bg-light {
    background-color: #f8f9fa !important;
}
</style>
@endsection

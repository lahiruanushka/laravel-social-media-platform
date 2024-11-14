@extends('layouts.app')
@section('content')
<div class="container py-5">
    <!-- Profile Header -->
    <div class="row mb-5">
        <div class="col-lg-4 text-center text-lg-start mb-4 mb-lg-0">
            <div class="position-relative d-inline-block">
                <img src="{{ asset($user->profile->image) }}"
                    alt="{{ $user->username }}'s avatar"
                    class="rounded-circle border shadow-sm"
                    style="width: 200px; height: 200px; object-fit: cover;">
            </div>
        </div>

        <div class="col-lg-8">
            <div class="mb-4">
                <div class="d-flex flex-wrap align-items-center gap-3 mb-3">
                    <h1 class="h3 fw-bold mb-0">{{ $user->username }}</h1>

                    @if (auth()->user() && auth()->user()->id === $user->id)
                        <div class="d-flex gap-2">
                            <a href="/profile/{{ $user->id }}/edit" class="btn btn-outline-primary">
                                <i class="fas fa-user-edit me-2"></i>Edit Profile
                            </a>
                            <a href="{{ route("posts.create") }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>New Post
                            </a>
                        </div>
                    @elseif (auth()->user())
                        <div>
                            @if (auth()->user()->following->contains($user->id))
                                <form action="{{ route('unfollow', $user) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-user-minus me-2"></i>Unfollow
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('follow', $user) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-user-plus me-2"></i>Follow
                                    </button>
                                </form>
                            @endif
                        </div>
                    @endif
                </div>

                <!-- Stats -->
                <div class="d-flex gap-4 mb-4">
                    <div class="text-center">
                        <h6 class="fw-bold mb-0">{{ $postCount }}</h6>
                        <small class="text-muted">Posts</small>
                    </div>
                    <div class="text-center">
                        <h6 class="fw-bold mb-0">{{ $followersCount }}</h6>
                        <small class="text-muted">Followers</small>
                    </div>
                    <div class="text-center">
                        <h6 class="fw-bold mb-0">{{ $followingCount }}</h6>
                        <small class="text-muted">Following</small>
                    </div>
                </div>

                <!-- Bio -->
                <div>
                    <h2 class="h5 fw-bold">{{ $user->profile->title }}</h2>
                    <p class="mb-2">{{ $user->profile->description }}</p>
                    @if ($user->profile->url)
                        <a href="{{ $user->profile->url }}" target="_blank" class="text-decoration-none">
                            <i class="fas fa-link me-2"></i>{{ $user->profile->url }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Posts Grid -->
    <div class="row g-4">
        @foreach ($user->posts as $post)
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 overflow-hidden">
                    <a href="/p/{{ $post->id }}" class="text-decoration-none">
                        <div class="position-relative">
                            @if ($post->image)
                                <img src="{{ asset($post->image) }}"
                                    class="card-img-top"
                                    alt="{{ $post->caption }}"
                                    style="height: 300px; object-fit: cover;">
                                <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-0 hover-overlay transition-opacity"
                                    style="opacity: 0; transition: opacity 0.3s;">
                                    <div class="position-absolute top-50 start-50 translate-middle text-white">
                                        <div class="d-flex gap-4">
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
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>

<style>
.hover-overlay:hover {
    opacity: 0.7 !important;
}

.transition-opacity {
    transition: opacity 0.3s ease-in-out;
}
</style>
@endsection

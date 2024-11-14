@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row g-4">
        <!-- Left Sidebar - Fixed -->
        <div class="col-md-3">
            <div class="position-sticky" style="top: 85px;">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4">
                            <img src="/api/placeholder/64/64" class="rounded-circle me-3" alt="Profile Picture">
                            <div>
                                <h5 class="mb-0">Welcome back!</h5>
                                <small class="text-muted">{{ Auth::user()->name }}</small>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h6 class="text-uppercase fw-bold text-secondary mb-3">Profile Settings</h6>
                            <div class="list-group list-group-flush">
                                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                                    <i class="bi bi-person-gear me-3"></i> Edit Profile
                                </a>
                                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                                    <i class="bi bi-key me-3"></i> Change Password
                                </a>
                                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                                    <i class="bi bi-bell me-3"></i> Notifications
                                </a>
                            </div>
                        </div>

                        <div>
                            <h6 class="text-uppercase fw-bold text-secondary mb-3">Quick Links</h6>
                            <div class="list-group list-group-flush">
                                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                                    <i class="bi bi-speedometer2 me-3"></i> Dashboard
                                </a>
                                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                                    <i class="bi bi-chat-dots me-3"></i> Messages
                                </a>
                                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                                    <i class="bi bi-gear me-3"></i> Settings
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content - Scrollable -->
        <div class="col-md-6" style="max-height: calc(100vh - 100px); overflow-y: auto;">
            <!-- Create Post Card -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <textarea class="form-control border-0" rows="3" placeholder="What's on your mind?"></textarea>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <button type="button" class="btn btn-outline-primary btn-sm me-2">
                                    <i class="bi bi-image"></i> Photo
                                </button>
                                <button type="button" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-emoji-smile"></i> Feeling
                                </button>
                            </div>
                            <button type="submit" class="btn btn-primary">Post</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Posts Feed -->
            @if ($posts->isEmpty())
                <div class="card shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="bi bi-newspaper display-1 text-muted mb-3"></i>
                        <h5>No Posts Yet</h5>
                        <p class="text-muted">Be the first one to share something!</p>
                    </div>
                </div>
            @else
               @foreach ($posts as $post)
    <x-post-card :post="$post" />
@endforeach

            @endif
        </div>

        <!-- Right Sidebar - Fixed -->
        <div class="col-md-3">
            <div class="position-sticky" style="top: 85px;">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h6 class="text-uppercase fw-bold text-secondary mb-3">Suggested Friends</h6>
                        <div class="suggested-user mb-3 d-flex align-items-center">
                            <img src="/api/placeholder/48/48" class="rounded-circle me-3" alt="User Profile">
                            <div>
                                <h6 class="mb-0">John Doe</h6>
                                <small class="text-muted">12 mutual friends</small>
                            </div>
                            <button class="btn btn-sm btn-primary ms-auto">Follow</button>
                        </div>
                        <div class="suggested-user mb-3 d-flex align-items-center">
                            <img src="/api/placeholder/48/48" class="rounded-circle me-3" alt="User Profile">
                            <div>
                                <h6 class="mb-0">Jane Smith</h6>
                                <small class="text-muted">8 mutual friends</small>
                            </div>
                            <button class="btn btn-sm btn-primary ms-auto">Follow</button>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body">
                        <h6 class="text-uppercase fw-bold text-secondary mb-3">Trending Topics</h6>
                        <div class="trending-topic mb-3">
                            <h6 class="mb-1">#WebDevelopment</h6>
                            <small class="text-muted">1.2K posts</small>
                        </div>
                        <div class="trending-topic mb-3">
                            <h6 class="mb-1">#Laravel</h6>
                            <small class="text-muted">856 posts</small>
                        </div>
                        <div class="trending-topic">
                            <h6 class="mb-1">#PHP</h6>
                            <small class="text-muted">642 posts</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Hide scrollbar for Chrome, Safari and Opera */
.col-md-6::-webkit-scrollbar {
    display: none;
}

/* Hide scrollbar for IE, Edge and Firefox */
.col-md-6 {
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;  /* Firefox */
}
</style>
@endsection

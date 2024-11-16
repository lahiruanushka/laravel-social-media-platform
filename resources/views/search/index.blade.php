 @extends('layouts.app')

@section('content')
<div class="container mt-3">
    <!-- Fixed Search Header -->
    <div class="position-sticky top-0 bg-white pt-2 pb-3 z-1">
        <div class="row mb-4">
            <div class="col-md-8 mx-auto">
                <form action="{{ route('search') }}" method="GET">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="search"
                               name="q"
                               class="form-control bg-light border-start-0"
                               placeholder="Search users and posts..."
                               value="{{ $query }}">
                    </div>
                </form>
            </div>
        </div>

        @if($query)
        <div class="row">
            <div class="col-md-8 mx-auto">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" id="users-tab" data-bs-toggle="tab" href="#users">
                            Users <span class="badge bg-secondary ms-1">{{ $users->total() }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="posts-tab" data-bs-toggle="tab" href="#posts">
                            Posts <span class="badge bg-secondary ms-1">{{ $posts->total() }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        @endif
    </div>

    @if($query)
    <!-- Search Results Content -->
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tab-content">
                <!-- Users Tab Content -->
                <div class="tab-pane fade show active" id="users">
                    @if($users->count() > 0)
                        @foreach($users as $user)
                           <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $user->profile->image ?? asset('images/Blank-Profile-Picture.webp') }}"
                                                 class="rounded-circle me-3"
                                                 style="width: 60px; height: 60px; object-fit: cover;">
                                            <div class="flex-grow-1">
                                                <h5 class="mb-1">
                                                    <a href="{{ route('profile.show', $user->id) }}"
                                                       class="text-decoration-none text-dark">
                                                        {{ $user->username }}
                                                    </a>
                                                </h5>
                                                <p class="text-muted mb-2">{{ $user->name }}</p>
                                                @auth
                                                    @if(Auth::id() !== $user->id)
                                                        @if(Auth::user()->following->contains($user->id))
                                                            <form action="{{ route('unfollow', $user->id) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-secondary">
                                                                    <i class="bi bi-person-dash"></i> Unfollow
                                                                </button>
                                                            </form>
                                                        @else
                                                            <form action="{{ route('follow', $user->id) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                <button type="submit" class="btn btn-sm btn-primary">
                                                                    <i class="bi bi-person-plus"></i> Follow
                                                                </button>
                                                            </form>
                                                        @endif
                                                    @endif
                                                @endauth
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        @endforeach

                        <div class="d-flex justify-content-center">
                            {{ $users->appends(['q' => $query])->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-person-x fs-1 text-muted"></i>
                            <p class="mt-3 text-muted">No users found matching "{{ $query }}"</p>
                        </div>
                    @endif
                </div>

                <!-- Posts Tab Content -->
                <div class="tab-pane fade" id="posts">
                    @if($posts->count() > 0)
                            @foreach($posts as $post)
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="{{ $post->user->profile->image ?? asset('images/Blank-Profile-Picture.webp') }}"
                                                 class="rounded-circle me-2"
                                                 style="width: 40px; height: 40px; object-fit: cover;">
                                            <div>
                                                <h6 class="mb-0">
                                                    <a href="{{ route('profile.show', $post->user->id) }}"
                                                       class="text-decoration-none text-dark">
                                                        {{ $post->user->username }}
                                                    </a>
                                                </h6>
                                                <small class="text-muted">
                                                    {{ $post->created_at->diffForHumans() }}
                                                </small>
                                            </div>
                                        </div>
                                        <p class="card-text">{{ $post->caption }}</p>
                                        @if($post->image)
                                            <img src="{{ asset($post->image) }}"
                                                 class="img-fluid rounded"
                                                 alt="Post image">
                                        @endif
                                    </div>
                                </div>
                            @endforeach

                            <!-- Posts Pagination -->
                            <div class="d-flex justify-content-center">
                                {{ $posts->appends(['q' => $query])->links() }}
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="bi bi-file-earmark-x fs-1 text-muted"></i>
                                <p class="mt-3 text-muted">No posts found matching "{{ $query }}"</p>
                            </div>
                        @endif
                </div>
            </div>
        </div>
    </div>
    @else
    <!-- Empty State -->
    <div class="text-center py-5">
        <i class="bi bi-search fs-1 text-muted"></i>
        <p class="mt-3 text-muted">Enter a search term to find users and posts</p>
    </div>
    @endif
</div>

@push('styles')
<style>
    /* Add z-index to ensure sticky header stays above content */
    .position-sticky {
        z-index: 1020;
    }

    /* Add shadow to sticky header when scrolled */
    .position-sticky.is-scrolled {
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    /* Ensure proper spacing for content below sticky header */
    .tab-content {
        padding-top: 1rem;
    }

    /* Keep existing styles */
    .nav-tabs .nav-link {
        color: #6c757d;
        font-weight: 500;
    }

    .nav-tabs .nav-link.active {
        color: #000;
        font-weight: 600;
    }

    .badge {
        font-weight: 500;
        font-size: 0.75em;
    }

    .card {
        transition: transform 0.2s ease-in-out;
    }

    .card:hover {
        transform: translateY(-2px);
    }

    .rounded-circle {
        transition: opacity 0.2s ease-in-out;
    }

    .rounded-circle:hover {
        opacity: 0.9;
    }

    @media (max-width: 768px) {
        .col-md-8.mx-auto {
            padding: 0 15px;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get active tab from URL hash or default to users
        const activeTab = window.location.hash || '#users';

        // Activate the tab
        const tab = new bootstrap.Tab(document.querySelector(`a[href="${activeTab}"]`));
        tab.show();

        // Add shadow to sticky header when scrolled
        const stickyHeader = document.querySelector('.position-sticky');
        if (stickyHeader) {
            window.addEventListener('scroll', () => {
                if (window.scrollY > 0) {
                    stickyHeader.classList.add('is-scrolled');
                } else {
                    stickyHeader.classList.remove('is-scrolled');
                }
            });
        }
    });
</script>
@endpush
@endsection


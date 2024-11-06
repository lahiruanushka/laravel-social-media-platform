@extends('layouts.app')
@section('content')
    <div class="container">
        <!-- Profile Info -->
        <div class="row mb-4">
            <div class="col-md-3 text-center">
                <img src="{{ asset($user->profile->image) }}" alt="Avatar" class="rounded-circle img-fluid mb-3">
                @can('update', $user->profile)
                    <a href="/profile/{{ $user->id }}/edit" class="btn btn-outline-primary btn-block mb-2">Edit Profile</a>
                    <a href="/p/create" class="btn btn-outline-primary btn-block mb-2">Add New Post</a>
                @endcan
            </div>
            <div class="col-md-9">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1 class="h4">{{ $user->username }}</h1>

                    @if (auth()->user()->following->contains($user->id))
                        <form action="{{ route('unfollow', $user) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Unfollow</button>
                        </form>
                    @else
                        <form action="{{ route('follow', $user) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-primary">Follow</button>
                        </form>
                    @endif
                </div>
                <div class="d-flex mb-3">
                    <div class="me-4"><strong>{{ $postCount }}</strong> posts</div>
                    <div class="me-4"><strong>{{ $followersCount }}</strong> followers</div>
                    <div class="me-4"><strong>{{ $followingCount }}</strong> following</div>
                </div>
                <h2 class="h5 font-weight-bold">{{ $user->profile->title }}</h2>
                <p>{{ $user->profile->description }}</p>
                @if ($user->profile->url)
                    <p><a href="{{ $user->profile->url }}" target="_blank">{{ $user->profile->url }}</a></p>
                @else
                    <p>N/A</p>
                @endif
            </div>
        </div>
        <!-- Profile Info -->

        <!-- Posts -->
        <div class="row">
            @foreach ($user->posts as $post)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <a href="/p/{{ $post->id }}">
                            @if ($post->image)
                                <img src="{{ asset($post->image) }}" class="img-fluid card-img-top rounded"
                                    alt="{{ $post->caption }}">
                            @endif
                        </a>

                    </div>
                </div>
            @endforeach
        </div>
        <!-- Posts -->
    </div>
@endsection

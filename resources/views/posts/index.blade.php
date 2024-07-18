@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        @foreach($posts as $post)
        <!-- User Details Section -->
        <div class="col-md-4">
            <div class="card p-3 mb-4">
                <div class="d-flex align-items-center">
                    <a href="/profile/{{ $post->user->id }}">
                        <div class="mr-3">
                            <img src="{{ asset('storage/' . $post->user->profile->image) }}" alt="Avatar" class="rounded-circle img-fluid mb-3" style="width: 50px; height: 50px;">
                        </div>
                    </a>
                    <div>
                        <h5 class="mb-0">
                            <a href="/profile/{{ $post->user->id }}" class="font-weight-bold text-dark">{{ $post->user->username }}</a>
                            <button type="button" class="btn btn-primary ml-3">Follow</button>
                        </h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- Post Image Section -->
        <div class="col-md-8 mb-4">
            <div class="card">
                <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top rounded" alt="Post Image">
                <div class="card-body">
                    <hr>
                    <p class="card-text">{{ $post->caption }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

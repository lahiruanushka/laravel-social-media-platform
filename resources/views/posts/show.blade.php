@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <!-- Post Image Section -->
            <div class="col-md-8 mb-4">
                <div class="card">
                    @if ($post->image)
                        <img src="{{ asset($post->image) }}" class="card-img-top rounded" alt="{{ $post->caption }}">
                    @endif
                </div>
            </div>

            <!-- Post Details Section -->
            <div class="col-md-4">
                <div class="card p-3">
                    <div class="d-flex align-items-center">
                        <div class="mr-3">
                            <img src="" alt="Avatar" class="rounded-circle img-fluid mb-3"
                                style="width: 50px; height: 50px;">

                        </div>
                        <div class="align-items-center">
                            <h5 class="mb-0 p-3">
                                <a href="/profile/{{ $post->user->id }}" class="font-weight-bold text-dark">
                                    {{ $post->user->username }}

                                </a>
                                <a href="#" class="btn btn-primary pl-3">
                                    Follow
                                </a>
                            </h5>
                        </div>
                    </div>
                    <hr>
                    <h5>{{ $post->caption }}</h5>
                </div>
            </div>
        </div>
    </div>
@endsection

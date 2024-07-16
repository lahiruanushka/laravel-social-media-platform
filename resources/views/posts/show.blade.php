@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <!-- Post Image Section -->
        <div class="col-md-8 mb-4">
            <div class="card">
                <img src="{{ asset('storage/' . $post->image) }}" alt="Image description" class="card-img-top">
            </div>
        </div>

        <!-- Post Details Section -->
        <div class="col-md-4">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <div class="mr-3">
                        <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" alt="User Avatar" class="rounded-circle" style="width: 50px; height: 50px;">
                    </div>
                    <div>
                        <h5 class="mb-0">{{ $post->user->username }}</h5>
                    </div>
                </div>
                <hr>
                <h5>{{ $post->caption }}</h5>
            </div>
        </div>
    </div>
</div>
@endsection

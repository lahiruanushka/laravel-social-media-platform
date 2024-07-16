@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="card-title text-center">Edit Profile</h2>

                    <!-- Form Start -->
                    <form action="/profile/{{$user->id}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <!-- Image Upload Input -->
                        <div class="mb-4 text-center">
                            <img src="{{ $user->profile->profile_image ?? 'default_image_url_here' }}" class="rounded-circle img-fluid mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                            <label for="profile-image" class="form-label">Profile Picture</label>
                            <input id="profile-image" type="file" class="form-control @error('profile-image') is-invalid @enderror" name="profile-image">
                            @error('profile-image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Title Input -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') ?? $user->profile->title }}" autofocus>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- URL Input -->
                        <div class="mb-3">
                            <label for="url" class="form-label">URL</label>
                            <input id="url" type="text" class="form-control @error('url') is-invalid @enderror" name="url" value="{{ old('url') ?? $user->profile->url }}">
                            @error('url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description Input -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" rows="4">{{ old('description') ?? $user->profile->description }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Save Profile</button>
                        </div>
                    </form>
                    <!-- Form End -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

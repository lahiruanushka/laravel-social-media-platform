@extends('layouts.app')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <h2 class="h3 fw-bold">Edit Your Profile</h2>
                        <p class="text-muted">Update your profile information and preferences</p>
                    </div>

                    <form action="/profile/{{ $user->id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <!-- Profile Image Upload -->
                        <div class="text-center mb-4">
                            <div class="position-relative d-inline-block">
                                <img src="{{ $user->profile->profile_image ?? 'default_image_url_here' }}"
                                    class="rounded-circle border shadow-sm mb-3"
                                    style="width: 150px; height: 150px; object-fit: cover;">
                                <label for="image" class="position-absolute bottom-0 end-0 bg-primary rounded-circle p-2 shadow-sm" style="cursor: pointer;">
                                    <i class="fas fa-camera text-white"></i>
                                    <input id="image" type="file" class="d-none @error('image') is-invalid @enderror" name="image">
                                </label>
                            </div>
                            @error('image')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Title Input -->
                        <div class="mb-4">
                            <label for="title" class="form-label fw-semibold">
                                <i class="fas fa-heading me-2"></i>Title
                            </label>
                            <input id="title" type="text"
                                class="form-control form-control-lg @error('title') is-invalid @enderror"
                                name="title" value="{{ old('title') ?? $user->profile->title }}"
                                placeholder="Your professional title">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Username Input -->
                        <div class="mb-4">
                            <label for="url" class="form-label fw-semibold">
                                <i class="fas fa-at me-2"></i>Username
                            </label>
                            <input id="url" type="text"
                                class="form-control form-control-lg @error('username') is-invalid @enderror"
                                name="username" value="{{ old('username') ?? $user->username }}"
                                placeholder="Your unique username">
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description Input -->
                        <div class="mb-4">
                            <label for="description" class="form-label fw-semibold">
                                <i class="fas fa-quote-left me-2"></i>Bio
                            </label>
                            <textarea id="description"
                                class="form-control form-control-lg @error('description') is-invalid @enderror"
                                name="description" rows="4"
                                placeholder="Tell us about yourself">{{ old('description') ?? $user->profile->description }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save me-2"></i>Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

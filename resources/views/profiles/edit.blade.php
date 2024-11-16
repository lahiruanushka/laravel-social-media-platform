@extends('layouts.app')

@section('content')
<div class="container py-4">

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif


    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <h2 class="display-6 fw-bold mb-2">Edit Profile</h2>
                        <p class="text-muted">Customize your profile information and appearance</p>
                    </div>

                    <form action="/profile/{{ $user->id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <!-- Profile Image Upload -->
                        <div class="text-center mb-5">
                            <div class="position-relative d-inline-block">
                                <img
                                    id="profileImagePreview"
                                    src="{{ $user->profile->image ? asset($user->profile->image) : asset('images/Blank-Profile-Picture.webp') }}"
                                    class="rounded-circle border border-3 border-white shadow-sm"
                                    style="width: 180px; height: 180px; object-fit: cover"
                                    alt="Profile Picture">

                                <label for="image" class="position-absolute bottom-0 end-0 bg-primary rounded-circle p-3 shadow-sm upload-btn">
                                    <i class="fas fa-camera text-white fs-5"></i>
                                    <input
                                        id="image"
                                        type="file"
                                        class="d-none @error('image') is-invalid @enderror"
                                        name="image"
                                        accept="image/*"
                                        onchange="previewImage(event)">
                                </label>
                            </div>
                            @error('image')
                                <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row g-4">
                            <!-- Name Input -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') ?? $user->name }}"
                                        placeholder="Your name">
                                    <label for="name">
                                        <i class="fas fa-user me-2"></i>Name
                                    </label>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Username Input -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input id="username" type="text"
                                        class="form-control @error('username') is-invalid @enderror"
                                        name="username" value="{{ old('username') ?? $user->username }}"
                                        placeholder="Your username">
                                    <label for="username">
                                        <i class="fas fa-at me-2"></i>Username
                                    </label>
                                    @error('username')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Title Input -->
                            <div class="col-12">
                                <div class="form-floating">
                                    <input id="title" type="text"
                                        class="form-control @error('title') is-invalid @enderror"
                                        name="title" value="{{ old('title') ?? $user->profile->title }}"
                                        placeholder="Your professional title">
                                    <label for="title">
                                        <i class="fas fa-heading me-2"></i>Professional Title
                                    </label>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Description Input -->
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea id="description"
                                        class="form-control @error('description') is-invalid @enderror"
                                        name="description"
                                        style="height: 120px"
                                        placeholder="Tell us about yourself">{{ old('description') ?? $user->profile->description }}</textarea>
                                    <label for="description">
                                        <i class="fas fa-quote-left me-2"></i>Bio
                                    </label>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save me-2"></i>Save Changes
                            </button>
                                <a href="{{ route('password.change') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-lock me-2"></i>  Change Password
                            </a>
                            <a href="/profile/{{ $user->id }}" class="btn btn-outline-success">
                                <i class="fas fa-arrow-left me-2"></i>Back to Profile
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.upload-btn {
    cursor: pointer;
    transition: transform 0.2s ease;
}

.upload-btn:hover {
    transform: scale(1.1);
}

.form-floating > label {
    padding-left: 1.5rem;
}

.form-control {
    border-radius: 8px;
    border: 1px solid #dee2e6;
    padding: 1rem;
}

.form-control:focus {
    border-color: #86b7fe;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

.btn {
    border-radius: 8px;
    padding: 0.8rem 1.5rem;
    font-weight: 500;
}

.card {
    border-radius: 16px;
}
</style>

<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function(){
        const output = document.getElementById('profileImagePreview');
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>
@endsection

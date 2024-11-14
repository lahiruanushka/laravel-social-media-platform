@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-4">
                        <div class="me-3">
                            <div class="rounded-circle overflow-hidden" style="width: 50px; height: 50px;">
                                <img src="{{ auth()->user()->avatar ?? '/images/default-avatar.png' }}"
                                     alt="Profile Picture"
                                     class="w-100 h-100 object-fit-cover">
                            </div>
                        </div>
                        <div>
                            <h5 class="mb-0">{{ auth()->user()->username }}</h5>
                            <small class="text-muted">Share your moments</small>
                        </div>
                    </div>

                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Image Preview -->
                        <div class="mb-4 text-center position-relative" id="imagePreviewContainer" style="display: none;">
                            <img id="imagePreview" src="#" alt="Preview" class="img-fluid rounded" style="max-height: 400px;">
                            <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-2" id="removeImage">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>

                        <!-- Drag & Drop Image Upload -->
                        <div class="mb-4">
                            <div class="upload-area p-5 rounded bg-light text-center @error('image') border border-danger @enderror"
                                 id="uploadArea">
                                <i class="fas fa-cloud-upload-alt fa-3x text-primary mb-3"></i>
                                <h5>Drag and drop your image here</h5>
                                <p class="text-muted mb-3">or</p>
                                <label class="btn btn-outline-primary px-4">
                                    Choose File
                                    <input type="file" name="image" id="image" class="d-none" accept="image/*">
                                </label>
                                @error('image')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Caption Input -->
                        <div class="mb-4">
                            <textarea name="caption"
                                      id="caption"
                                      rows="3"
                                      class="form-control form-control-lg @error('caption') is-invalid @enderror"
                                      placeholder="Write a caption..."
                            >{{ old('caption') }}</textarea>
                            @error('caption')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Additional Options -->
                        <div class="mb-4">
                            <div class="d-flex gap-3">
                                <button type="button" class="btn btn-outline-secondary">
                                    <i class="fas fa-map-marker-alt"></i> Add Location
                                </button>
                                <button type="button" class="btn btn-outline-secondary">
                                    <i class="fas fa-user-tag"></i> Tag People
                                </button>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('home') }}" class="btn btn-light px-4">Cancel</a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-paper-plane me-2"></i>Share Post
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const uploadArea = document.getElementById('uploadArea');
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');
    const imagePreviewContainer = document.getElementById('imagePreviewContainer');
    const removeImageBtn = document.getElementById('removeImage');

    // Drag and drop functionality
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        uploadArea.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, unhighlight, false);
    });

    function highlight(e) {
        uploadArea.classList.add('bg-light-hover');
    }

    function unhighlight(e) {
        uploadArea.classList.remove('bg-light-hover');
    }

    uploadArea.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        handleFiles(files);
    }

    // Handle file selection
    imageInput.addEventListener('change', function() {
        handleFiles(this.files);
    });

    function handleFiles(files) {
        if (files.length > 0) {
            const file = files[0];
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreviewContainer.style.display = 'block';
                    uploadArea.style.display = 'none';
                }
                reader.readAsDataURL(file);
            }
        }
    }

    // Remove image
    removeImageBtn.addEventListener('click', function() {
        imageInput.value = '';
        imagePreviewContainer.style.display = 'none';
        uploadArea.style.display = 'block';
    });
});
</script>
@endpush
@endsection

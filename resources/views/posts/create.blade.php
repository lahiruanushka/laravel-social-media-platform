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
                                <img src="{{ Auth::user()->profile->image ? asset(Auth::user()->profile->image) : asset('images/Blank-Profile-Picture.webp') }}"
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
                        <div class="position-relative mb-4 text-center">
                            <div id="imagePreviewContainer" class="d-none">
                                <img id="imagePreview" src="#" alt="Preview" class="img-fluid rounded shadow">
                                <button type="button" id="removeImage" class="btn btn-danger position-absolute top-0 end-0 m-2">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <div class="upload-area p-5 rounded bg-light text-center @error('image') border border-danger @enderror">
                                <i class="fas fa-cloud-upload-alt fa-3x text-primary mb-3"></i>
                                <h5 class="mb-3">Drag & Drop your image here or click to select a file</h5>
                                <p class="text-muted">Accepted file types: .jpg, .jpeg, .png</p>
                                <label class="btn btn-outline-primary">
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
                                      placeholder="Write a caption...">{{ old('caption') }}</textarea>
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
                            <a href="{{ route('home') }}" class="btn btn-light">Cancel</a>
                            <button type="submit" class="btn btn-primary">
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
    // Get DOM elements
    const uploadArea = document.querySelector('.upload-area');
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');
    const imagePreviewContainer = document.getElementById('imagePreviewContainer');
    const removeImageBtn = document.getElementById('removeImage');

    // Prevent default drag behaviors
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, preventDefaults, false);
        document.body.addEventListener(eventName, preventDefaults, false);
    });

    // Highlight drop zone when dragging over it
    ['dragenter', 'dragover'].forEach(eventName => {
        uploadArea.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, unhighlight, false);
    });

    // Handle dropped files
    uploadArea.addEventListener('drop', handleDrop, false);

    // Handle file input change
    imageInput.addEventListener('change', handleFileSelect, false);

    // Handle remove button click
    removeImageBtn.addEventListener('click', removeImage, false);

    // Utility functions
    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    function highlight(e) {
        uploadArea.classList.add('bg-light-hover');
    }

    function unhighlight(e) {
        uploadArea.classList.remove('bg-light-hover');
    }

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;

        handleFiles(files);
    }

    function handleFileSelect(e) {
        const files = e.target.files;
        handleFiles(files);
    }

    function handleFiles(files) {
        if (files.length > 0) {
            const file = files[0];

            // Validate file type
            if (!file.type.match('image.*')) {
                alert('Please upload an image file (jpg, jpeg, png)');
                return;
            }

            // Validate file size (e.g., max 5MB)
            if (file.size > 5 * 1024 * 1024) {
                alert('Please upload an image smaller than 5MB');
                return;
            }

            const reader = new FileReader();

            reader.onload = function(e) {
                // Show preview
                imagePreview.src = e.target.result;
                imagePreviewContainer.classList.remove('d-none');
                uploadArea.classList.add('d-none');
            };

            reader.onerror = function() {
                alert('Error reading file');
                removeImage();
            };

            reader.readAsDataURL(file);
        }
    }

    function removeImage() {
        // Clear the file input
        imageInput.value = '';

        // Clear the preview
        imagePreview.src = '';

        // Hide preview container and show upload area
        imagePreviewContainer.classList.add('d-none');
        uploadArea.classList.remove('d-none');
    }
});
</script>
  @endpush
@endsection

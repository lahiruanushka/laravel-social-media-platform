@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <div class="rounded-circle overflow-hidden" style="width: 50px; height: 50px;">
                                    <img src="{{ Auth::user()->profile->image ? asset(Auth::user()->profile->image) : asset('images/Blank-Profile-Picture.webp') }}"
                                         alt="Profile Picture"
                                         class="w-100 h-100 object-fit-cover">
                                </div>
                            </div>
                            <div>
                                <h5 class="mb-0">Edit Post</h5>
                                <small class="text-muted">Posted {{ $post->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-link text-dark p-0" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="fas fa-trash-alt me-2"></i>Delete Post
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <!-- Image Preview Section -->
                        <div class="mb-4">
                            <!-- Current/New Image Preview -->
                            <div id="imagePreviewContainer" class="text-center">
                                <img id="imagePreview"
                                     src="{{ asset($post->image) }}"
                                     alt="Post Image"
                                     class="img-fluid rounded shadow-sm"
                                     style="max-height: 400px;">
                            </div>

                            <!-- New Image Upload -->
                            <div class="mt-3">
                                <div class="upload-area p-4 rounded bg-light text-center @error('image') border border-danger @enderror">
                                    <i class="fas fa-exchange-alt fa-2x text-primary mb-3"></i>
                                    <p class="mb-2">Upload a new image to replace the current one</p>
                                    <div class="d-flex justify-content-center gap-2">
                                        <label class="btn btn-outline-primary px-4">
                                            Choose New Image
                                            <input type="file" name="image" id="image" class="d-none" accept="image/*">
                                        </label>
                                        <button type="button" id="removeNewImage" class="btn btn-outline-danger px-4 d-none">
                                            <i class="fas fa-times me-2"></i>Cancel New Image
                                        </button>
                                    </div>
                                    @error('image')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Caption Input -->
                        <div class="mb-4">
                            <label class="form-label">Caption</label>
                            <textarea name="caption"
                                      id="caption"
                                      rows="3"
                                      class="form-control form-control-lg @error('caption') is-invalid @enderror"
                                      placeholder="Write a caption..."
                            >{{ old('caption', $post->caption) }}</textarea>
                            @error('caption')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Additional Options -->
                        <div class="mb-4">
                            <div class="d-flex gap-3">
                                <button type="button" class="btn btn-outline-secondary">
                                    <i class="fas fa-map-marker-alt"></i> Update Location
                                </button>
                                <button type="button" class="btn btn-outline-secondary">
                                    <i class="fas fa-user-tag"></i> Edit Tags
                                </button>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('posts.show', $post) }}" class="btn btn-light px-4">Cancel</a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save me-2"></i>Save Changes
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
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');
    const removeNewImageBtn = document.getElementById('removeNewImage');
    const originalImageSrc = imagePreview.src;

    // Handle file input change
    imageInput.addEventListener('change', function(e) {
        const file = this.files[0];
        if (file) {
            // Validate file type
            if (!file.type.match('image.*')) {
                alert('Please select an image file');
                return;
            }

            // Validate file size (5MB max)
            if (file.size > 5 * 1024 * 1024) {
                alert('Please select an image smaller than 5MB');
                return;
            }

            // Show preview
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                removeNewImageBtn.classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        }
    });

    // Handle remove new image
    removeNewImageBtn.addEventListener('click', function() {
        imageInput.value = ''; // Clear file input
        imagePreview.src = originalImageSrc; // Restore original image
        this.classList.add('d-none'); // Hide remove button
    });
});
</script>
  @endpush

@endsection

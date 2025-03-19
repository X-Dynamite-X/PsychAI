@extends('layouts.app')

@section('styles')
<style>
    .form-container {
        max-width: 800px;
        margin: 2rem auto;
        padding: 2rem;
        background-color: #FCEBDC;
        border-radius: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .form-header {
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 2px dashed #81AD74;
    }

    .input-group {
        margin-bottom: 1.5rem;
    }

    .input-label {
        display: block;
        font-size: 0.95rem;
        font-weight: 600;
        color: #403540;
        margin-bottom: 0.5rem;
    }

    .form-input {
        width: 100%;
        padding: 0.75rem;
        border: 2px solid #E2E8F0;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .form-input:focus {
        border-color: #81AD74;
        box-shadow: 0 0 0 3px rgba(129, 173, 116, 0.2);
        outline: none;
    }

    .thumbnail-preview {
        margin-top: 1rem;
        text-align: center;
    }

    .thumbnail-preview img {
        max-width: 300px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .submit-button {
        background-color: #81AD74;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .submit-button:hover {
        background-color: #6a8f63;
        transform: translateY(-2px);
    }

    .error-container {
        background-color: #FEE2E2;
        border: 1px solid #EF4444;
        border-radius: 8px;
        padding: 1rem;
        margin-top: 1rem;
    }
</style>
@endsection

@section('content')
<div class="form-container">
    <div class="form-header flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900">Edit Video</h1>
        <a href="{{ route('video.index') }}"
           class="text-green-600 hover:text-green-700 font-medium flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Back to Videos
        </a>
    </div>

    <form id="videoForm" class="space-y-6" method="POST" action="{{ route('video.update', $video) }}" enctype="multipart/form-data" >
        @csrf
        @method('PUT')

        <div class="input-group">
            <label for="title" class="input-label">Title</label>
            <input type="text" id="title" name="title" class="form-input"
                   value="{{ $video->title }}"
                   placeholder="Enter video title">
        </div>

        <div class="input-group">
            <label for="url" class="input-label">Video URL</label>
            <input type="url" id="url" name="url" class="form-input"
                   value="{{ $video->url }}"
                   placeholder="Enter video URL (YouTube, Vimeo, etc.)">
        </div>

        <div class="input-group">
            <label for="category_id" class="input-label">Category</label>
            <select id="category_id" name="category_id" class="form-input">
                <option value="">Select a category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                            {{ $video->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="input-group">
            <label for="image" class="input-label">Thumbnail Image</label>
            <input type="file" id="image" name="image"
                   class="form-input"
                   accept="image/jpeg,image/png,image/jpg,image/gif">
            <div id="thumbnailPreview" class="thumbnail-preview {{ $video->thumbnail ? '' : 'hidden' }}">
                <img src="{{ $video->thumbnail ? Storage::url($video->thumbnail) : '#' }}"
                     alt="Thumbnail preview">
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="submit-button flex items-center">
                <i class="fas fa-save mr-2"></i> Update Video
            </button>
        </div>

        <div id="errorMessage" class="error-container hidden">
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
                <span class="error-text text-red-500"></span>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('thumbnailPreview');
            preview.querySelector('img').src = e.target.result;
            preview.classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
});

document.getElementById('videoForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(this);
    const submitButton = this.querySelector('button[type="submit"]');
    const errorMessage = document.getElementById('errorMessage');
    const errorText = errorMessage.querySelector('.error-text');

    submitButton.disabled = true;
    submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Updating...';

    fetch('{{ route("video.update", $video) }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = '{{ route("video.index") }}';
        } else {
            throw new Error(data.message || 'Error updating video');
        }
    })
    .catch(error => {
        errorText.textContent = error.message;
        errorMessage.classList.remove('hidden');
        submitButton.disabled = false;
        submitButton.innerHTML = '<i class="fas fa-save mr-2"></i> Update Video';
    });
});
</script>
@endpush


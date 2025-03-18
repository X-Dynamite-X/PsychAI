@extends('layouts.app')

@section('styles')
<style>
    .video-container {
        max-width: 1000px;
        margin: 2rem auto;
        padding: 2rem;
        background-color: #FCEBDC;
        border-radius: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .video-header {
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 2px dashed #81AD74;
    }

    .video-frame {
        background-color: #000;
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 2rem;
    }

    .video-details {
        background-color: white;
        border-radius: 10px;
        padding: 1.5rem;
        margin-top: 2rem;
    }

    .category-badge {
        background-color: #E8F5E9;
        color: #2E7D32;
        padding: 0.5rem 1rem;
        border-radius: 999px;
        font-weight: 600;
        font-size: 0.875rem;
    }

    .action-button {
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .edit-button {
        background-color: #81AD74;
        color: white;
    }

    .edit-button:hover {
        background-color: #6a8f63;
        transform: translateY(-2px);
    }
</style>
@endsection

@section('content')
<div class="video-container">
    <div class="video-header flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900">{{ $video->title }}</h1>
        <a href="{{ route('video.index') }}"
           class="text-green-600 hover:text-green-700 font-medium flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Back to Videos
        </a>
    </div>

    <div class="video-frame">
        <div class="relative" style="padding-top: 56.25%;">
            <iframe
                src="{{ $video->url }}"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen
                class="absolute top-0 left-0 w-full h-full">
            </iframe>
        </div>
    </div>

    <div class="video-details">
        <div class="flex items-center justify-between mb-4">
            <span class="category-badge">
                {{ $video->category->name }}
            </span>

            @if(auth()->id() === $video->user_id)
                <div class="flex space-x-2">
                    <a href="{{ route('video.edit', $video) }}"
                       class="action-button edit-button flex items-center">
                        <i class="fas fa-edit mr-2"></i> Edit Video
                    </a>
                </div>
            @endif
        </div>

        <div class="mt-4">
            <h2 class="text-xl font-semibold text-gray-900 mb-2">Description</h2>
            <p class="text-gray-700">{{ $video->description }}</p>
        </div>

        @if($relatedVideos->count() > 0)
            <div class="mt-8">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Related Videos</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach($relatedVideos as $relatedVideo)
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                            <div class="relative pb-[56.25%]">
                                @if($relatedVideo->thumbnail)
                                    <img src="{{ Storage::url($relatedVideo->thumbnail) }}"
                                         alt="{{ $relatedVideo->title }}"
                                         class="absolute h-full w-full object-cover">
                                @else
                                    <div class="absolute h-full w-full bg-gray-200 flex items-center justify-center">
                                        <i class="fas fa-video text-4xl text-gray-400"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="p-4">
                                <h3 class="font-semibold text-gray-900">{{ $relatedVideo->title }}</h3>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection



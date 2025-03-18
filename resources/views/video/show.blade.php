@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-900">{{ $video->title }}</h1>
            <a href="{{ route('video.index') }}"
               class="text-green-600 hover:text-green-700 font-medium">
                <i class="fas fa-arrow-left mr-2"></i> Back to Videos
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-lg overflow-hidden h-full">
            <div class="aspect-w-16 aspect-h-9 ">
                <iframe src="{{ $video->url }}"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen
                        height="15rem"
                        
                        class="w-full h-full"></iframe>
            </div>

            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <span class="bg-green-100 text-green-800 text-sm font-medium px-2.5 py-0.5 rounded-full">
                        {{ $video->category->name }}
                    </span>

                    <div class="flex space-x-2">
                        <a href="{{ route('video.edit', $video) }}"
                           class="text-blue-600 hover:text-blue-800">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                    </div>
                </div>

                <p class="text-gray-700 mb-4">{{ $video->description }}</p>
            </div>
        </div>
    </div>
</div>
@endsection

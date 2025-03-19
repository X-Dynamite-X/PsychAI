@extends('layouts.app')

@section('styles')
    <style>
        .videos-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: #FCEBDC;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .page-header {
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px dashed #81AD74;
        }

        .add-button {
            background-color: #81AD74;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 600;
        }

        .add-button:hover {
            background-color: #6a8f63;
            transform: translateY(-2px);
        }

        .video-card {
            background-color: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            border: 1px solid #E2E8F0;
        }

        .video-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .video-thumbnail {
            position: relative;
            padding-bottom: 56.25%;
            background-color: #F3F4F6;
        }

        .category-badge {
            background-color: #81AD74;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 999px;
            font-size: 0.875rem;
        }

        .action-button {
            padding: 0.5rem;
            border-radius: 6px;
            transition: all 0.2s ease;
        }

        .edit-button {
            color: #81AD74;
        }

        .delete-button {
            color: #EF4444;
        }

        .modal-container {
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
        }

        .modal-content {
            background-color: #FCEBDC;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .modal-button {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .confirm-button {
            background-color: #EF4444;
            color: white;
        }

        .confirm-button:hover {
            background-color: #DC2626;
        }

        .pagination-container {
            padding: 1rem;
            background-color: white;
            border-radius: 0 0 12px 12px;
            border-top: 1px solid #E2E8F0;
        }
    </style>
@endsection

@section('content')
    <div class="videos-container">
        @if (!$videos->isEmpty())
            @role(['doctor', 'admin'])
                <div class="page-header flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-gray-900">Videos</h1>
                    <a href="{{ route('video.create') }}" class="add-button flex items-center">
                        <i class="fas fa-plus mr-2"></i> Add New Video
                    </a>
                </div>
            @endrole()
        @endif
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($videos as $video)
                <div class="video-card">
                    <div class="video-thumbnail">
                        @if ($video->image)
                            <img src="{{ asset('storage/' . $video->image) }}" alt="{{ $video->title }}"
                                class="absolute h-full w-full object-cover">
                        @else
                            <div class="absolute h-full w-full flex items-center justify-center">
                                <i class="fas fa-video text-4xl text-gray-400"></i>
                            </div>
                        @endif
                    </div>

                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $video->title }}</h3>
                        <p class="text-gray-600 text-sm mb-4">{{ Str::limit($video->description, 100) }}</p>

                        <div class="flex items-center justify-between">
                            <span class="category-badge">
                                <a href="{{ route('video.category', $video->category->id) }}" class="hover:text-green-600">
                                    {{ $video->category->name }}
                                </a>
                            </span>
                            @if (auth()->id() === $video->user_id)
                                <div class="flex space-x-2">
                                    <a href="{{ route('video.show', $video) }}" class="action-button edit-button">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('video.edit', $video) }}" class="action-button edit-button">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('video.destroy', $video) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Are you sure you want to delete this video?')">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="action-button delete-button">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <i class="fas fa-video text-6xl text-gray-400 mb-4"></i>
                    <p class="text-gray-500 text-lg">No videos found</p>
                    @role(['doctor', 'admin'])
                        <a href="{{ route('video.create') }}" class="add-button inline-flex items-center mt-4">
                            <i class="fas fa-plus mr-2"></i> Add Your First Video
                        </a>
                    @endrole
                </div>
            @endforelse
        </div>
        @if ($videos->count() > 10)
            <div class="pagination-container mt-6">
                {{ $videos->links() }}
            </div>
        @endif
    </div>
@endsection

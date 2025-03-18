@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Videos</h1>
        <a href="{{ route('video.create') }}"
           class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg flex items-center">
            <i class="fas fa-plus mr-2"></i> Add New Video
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
            @forelse ($videos as $video)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200">
                    <div class="relative pb-[56.25%]">
                        @if($video->thumbnail)
                            <img src="{{ Storage::url($video->thumbnail) }}"
                                 alt="{{ $video->title }}"
                                 class="absolute h-full w-full object-cover">
                        @else
                            <div class="absolute h-full w-full bg-gray-200 flex items-center justify-center">
                                <i class="fas fa-video text-4xl text-gray-400"></i>
                            </div>
                        @endif
                    </div>

                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $video->title }}</h3>
                        <p class="text-gray-600 text-sm mb-4">{{ Str::limit($video->description, 100) }}</p>

                        <div class="flex items-center justify-between">
                            <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                {{ $video->category->name }}
                            </span>

                            <div class="flex space-x-2">
                                <a href="{{ route('video.show', $video) }}"
                                   class="text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button onclick="deleteVideo({{ $video->id }})"
                                        class="text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <i class="fas fa-video text-4xl text-gray-400 mb-4"></i>
                    <p class="text-gray-500">No videos found</p>
                </div>
            @endforelse
        </div>

        <div class="px-6 py-4 border-t border-gray-200">
            {{ $videos->links() }}
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center">
    <div class="bg-white rounded-lg p-8 max-w-md mx-auto">
        <h3 class="text-xl font-bold mb-4">Confirm Deletion</h3>
        <p class="text-gray-600 mb-6">Are you sure you want to delete this video? This action cannot be undone.</p>
        <div class="flex justify-end space-x-4">
            <button onclick="closeDeleteModal()"
                    class="px-4 py-2 text-gray-600 hover:text-gray-800">
                Cancel
            </button>
            <button onclick="confirmDelete()"
                    class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                Delete
            </button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
let currentDeleteId = null;

function deleteVideo(id) {
    currentDeleteId = id;
    document.getElementById('deleteModal').classList.remove('hidden');
    document.getElementById('deleteModal').classList.add('flex');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
    document.getElementById('deleteModal').classList.remove('flex');
    currentDeleteId = null;
}

function confirmDelete() {
    if (!currentDeleteId) return;

    fetch(`/video/${currentDeleteId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.reload();
        } else {
            alert('Error deleting video');
        }
    })
    .catch(error => {
        alert('Error deleting video');
    })
    .finally(() => {
        closeDeleteModal();
    });
}
</script>
@endpush

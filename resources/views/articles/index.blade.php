@extends('layouts.app')
@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Header Section -->
          @if (!$articles->isEmpty())
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">المقالات</h1> <a href="{{ route('articles.create') }}"
                class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg transition duration-300 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                        clip-rule="evenodd" />
                </svg>
                إضافة مقال جديد </a>
        </div>
        @endif
        <!-- Articles Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($articles as $article)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                    @if ($article->image)
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}"
                                class="w-full h-full object-cover transform hover:scale-105 transition duration-300">
                        </div>
                    @endif
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">
                                {{ $article->category->name }}
                            </span>
                        </div>
                        <h2 class="text-xl font-bold text-gray-800 mb-3">{{ $article->title }}</h2>
                        <p class="text-gray-600 mb-4 line-clamp-3">
                            {{ $article->description }} </p>
                        <div class="flex justify-between items-center">
                            <a href="{{ route('articles.show', $article->id) }}"
                                class="text-green-600 hover:text-green-700 font-medium flex items-center">
                                قراءة المزيد <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1 rtl:rotate-180"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                            <div class="flex space-x-2 rtl:space-x-reverse"> <a
                                    href="{{ route('articles.edit', $article->id) }}"
                                    class="text-blue-600 hover:text-blue-800"> <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                        <path fill-rule="evenodd"
                                            d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                            clip-rule="evenodd" />
                                    </svg> </a>
                                <form action="{{ route('articles.destroy', $article->id) }}" method="POST" class="inline"
                                    onsubmit="return confirm('هل أنت متأكد من حذف هذا المقال؟')"> @csrf
                                    @method('DELETE') <button type="submit" class="text-red-600 hover:text-red-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg> </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Pagination -->
        <div class="mt-8">
            {{ $articles->links() }} </div>
        <!-- No Articles Message -->
        @if ($articles->isEmpty())
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">لا توجد مقالات</h3>
                <p class="mt-1 text-sm text-gray-500">ابدأ بإضافة مقال جديد</p>
                <div class="mt-6">
                    <a href="{{ route('articles.create') }}"
                        class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                        إضافة مقال جديد </a>
                </div>
            </div>
        @endif
    </div>
@endsection

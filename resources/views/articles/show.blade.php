@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $article->title }}</h1>
        <p><strong>Category:</strong> {{ $article->category->name }}</p>
        <p><strong>Description:</strong> {{ $article->description }}</p>

        @if ($article->image)
            <img src="{{ asset('storage/' . $article->image) }}" class="img-fluid" alt="Article Image">
        @endif

        <a href="{{ route('articles.index') }}" class="btn btn-secondary mt-3">Back to Articles</a>
    </div>
@endsection
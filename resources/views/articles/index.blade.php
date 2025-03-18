<form method="GET" action="{{ route('articles.index') }}">
    <input type="text" name="search" placeholder="Search articles..." value="{{ request('search') }}">
    <select name="category_id">
        <option value="">All Categories</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    <select name="sort_by">
        <option value="">Sort By</option>
        <option value="title" {{ request('sort_by') == 'title' ? 'selected' : '' }}>Title</option>
        <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Date</option>
    </select>
    <button type="submit">Search</button>
</form>

@foreach ($articles as $article)
    <div>
        <h3>{{ $article->title }}</h3>
        <p>{{ $article->description }}</p>
        @if ($article->image)
            <img src="{{ asset('storage/' . $article->image) }}" alt="Article Image" width="100">
        @endif
        <a href="{{ route('articles.show', $article->id) }}">View Details</a>
    </div>
@endforeach

{{ $articles->links() }}
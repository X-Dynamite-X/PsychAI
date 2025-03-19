
<div class="subtitle">
    Browse a variety of mental disorders to get started
    <div class="arrow">↓</div>
</div>

@foreach ($categories as $category)

<div class="category-section">
    <div class="category-title"><em>{{ $category->name }}</em></div>
    <div class="category-buttons">
        <span class="btn-chat">
            <a href="{{ route('chat') }}">
                AI Chat
            </a>
        </span>
        <span class="btn-articles">
            <a href="{{ route('articles.category', $category->id) }}">
                Articles
            </a>
        </span>
        <span class="btn-articles">
            <a href="{{ route('video.category', $category->id) }}">
                Videos
            </a>
        </span>
    </div>
    <div class="category-description">
        {{ $category->description }}
    </div>
</div>

@endforeach

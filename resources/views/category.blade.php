
<div class="subtitle">
    Browse a variety of mental disorders to get started
    <div class="arrow">↓</div>
</div>

@foreach ($categories as $category)

<div class="category-section">
    <div class="category-title"><em>{{ $category->name }}</em></div>
    <div class="category-buttons">
        <span class="btn-chat">AI Chat</span>
        <span class="btn-articles">Articles</span>
    </div>
    <div class="category-description">
        {{ $category->description }}
    </div>
</div>

@endforeach

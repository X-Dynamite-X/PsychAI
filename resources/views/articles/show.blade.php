@extends('layouts.app')

@section('styles')
<style>
    .article-container {
        max-width: 900px;
        margin: 2rem auto;
        padding: 2rem;
        background-color: #FCEBDC;
        border-radius: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .article-header {
        text-align: center;
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 2px dashed #81AD74;
    }

    .article-title {
        font-size: 2.5rem;
        color: #403540;
        font-weight: bold;
        margin-bottom: 1rem;
    }

    .article-category {
        display: inline-block;
        background-color: #81AD74;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }

    .article-image-container {
        margin: 2rem 0;
        text-align: center;
    }

    .article-image {
        max-width: 100%;
        height: auto;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .article-content {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #403540;
        margin: 2rem 0;
        white-space: pre-line;
    }

    .back-button {
        display: inline-flex;
        align-items: center;
        background-color: #81AD74;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.3s ease;
        margin-top: 2rem;
    }

    .back-button:hover {
        background-color: #6a8f63;
        transform: translateY(-2px);
    }

    .back-button svg {
        margin-right: 0.5rem;
    }

    @media (max-width: 768px) {
        .article-container {
            margin: 1rem;
            padding: 1rem;
        }

        .article-title {
            font-size: 2rem;
        }
    }

    /* أنماط جديدة للتعليقات */
    .comments-section {
        margin-top: 3rem;
        padding-top: 2rem;
        border-top: 2px dashed #81AD74;
    }

    .comments-title {
        font-size: 1.5rem;
        color: #403540;
        margin-bottom: 1.5rem;
    }

    .comment-form {
        margin-bottom: 2rem;
    }

    .comment-input {
        width: 100%;
        padding: 1rem;
        border: 1px solid #81AD74;
        border-radius: 8px;
        margin-bottom: 1rem;
        background-color: white;
    }

    .comment-card {
        background-color: white;
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .comment-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.5rem;
        color: #666;
        font-size: 0.9rem;
    }

    .comment-content {
        color: #403540;
    }

    .submit-button {
        background-color: #81AD74;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .submit-button:hover {
        background-color: #6a8f63;
    }
</style>
@endsection

@section('content')
<div class="article-container">
    <div class="article-header">
        <h1 class="article-title">{{ $article->title }}</h1>
        <span class="article-category">{{ $article->category->name }}</span>
    </div>

    @if ($article->image)
        <div class="article-image-container">
            <img src="{{ asset('storage/' . $article->image) }}"
                 class="article-image"
                 alt="{{ $article->title }}">
        </div>
    @endif

    <div class="article-content">
        {{ $article->content }}
    </div>

    <!-- قسم التعليقات الجديد -->
    <div class="comments-section">
        <h2 class="comments-title">التعليقات</h2>

        @auth
            <form action="{{ route('articles.comment.store', $article) }}" method="POST" class="comment-form">
                @csrf
                <textarea name="commant"
                          class="comment-input"
                          rows="3"
                          placeholder="أضف تعليقك هنا..."
                          required></textarea>
                <button type="submit" class="submit-button">إرسال التعليق</button>
            </form>
        @else
            <p class="text-center text-gray-600 mb-4">
                <a href="{{ route('login') }}" class="text-blue-600 hover:underline">سجل دخول</a>
                لإضافة تعليق
            </p>
        @endauth

        <div class="comments-list">
            @foreach($article->comments as $commant)
                <div class="comment-card">
                    <div class="comment-header">
                        <span class="comment-author">{{ $commant->user->name }}</span>
                        <span class="comment-date">{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="comment-content">
                        {{ $commant->commant }}
                    </div>
                </div>
            @endforeach
                <p class="text-center text-gray-600">لا توجد تعليقات بعد. كن أول من يعلق!</p>
        </div>
    </div>

    <div class="flex justify-between items-center">
        <a href="{{ route('articles.index') }}" class="back-button">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                      d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L4.414 9H17a1 1 0 110 2H4.414l5.293 5.293a1 1 0 010 1.414z"
                      clip-rule="evenodd" />
            </svg>
            Back to Articles
        </a>

        @if(auth()->id() === $article->user_id)
            <div class="flex gap-4">
                <a href="{{ route('articles.edit', $article) }}"
                   class="back-button bg-blue-600 hover:bg-blue-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                    </svg>
                    Edit Article
                </a>
            </div>
        @endif
    </div>
</div>
@endsection



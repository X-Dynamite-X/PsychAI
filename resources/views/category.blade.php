@extends('layouts.app')
@section("styles")
<style>
    .subtitle {
        font-size: 22px;
        color: #403540;
        line-height: 1.5;
        margin-bottom: 20px;
        text-align: center;
        margin-top: 80px;
    }

    .category-section {
        text-align: left;
        width: 60%;
        margin: 30px auto;
        padding: 20px 25px;
        border-radius: 10px;
        border-bottom: 2px dashed #5E875E;
        transition: transform 0.2s;
    }

    .category-section:hover {
        transform: translateY(-5px);
        background-color: #FCEBD4;
    }

    .category-title {
        font-size: 24px;
        font-weight: bold;
        color: #5E875E;
    }

    .category-buttons {
        display: flex;
        gap: 10px;
        margin-top: 10px;
    }

    .btn-chat, .btn-articles {
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-chat {
        background-color: #5E875E;
        color: white;
    }

    .btn-chat:hover {
        background-color: #4a6b4a;
    }

    .btn-articles {
        border: 2px solid #5E875E;
        color: #5E875E;
        background-color: transparent;
    }

    .btn-articles:hover {
        background-color: #5E875E;
        color: white;
    }

    .category-description {
        font-size: 16px;
        color: #403540;
        margin-top: 10px;
    }
</style>
@endsection

@section('content')
<div class="subtitle">
    Browse a variety of mental disorders to get started
    <div class="arrow">↓</div>
</div>

<div class="category-section">
    <div class="category-title"><em>Anxiety</em></div>
    <div class="category-buttons">
        <span class="btn-chat">AI Chat</span>
        <span class="btn-articles">Articles</span>
    </div>
    <div class="category-description">
        A mental health condition characterized by excessive worry, fear, or tension.
    </div>
</div>

<div class="category-section">
    <div class="category-title"><em>Depression</em></div>
    <div class="category-buttons">
        <span class="btn-chat">AI Chat</span>
        <span class="btn-articles">Articles</span>
    </div>
    <div class="category-description">
        A mood disorder marked by persistent feelings of sadness and loss of interest.
    </div>
</div>

<div class="category-section">
    <div class="category-title"><em>Burnout</em></div>
    <div class="category-buttons">
        <span class="btn-chat">AI Chat</span>
        <span class="btn-articles">Articles</span>
    </div>
    <div class="category-description">
        A state of emotional, physical, and mental exhaustion caused by prolonged stress.
    </div>
</div>

<div class="category-section">
    <div class="category-title"><em>Impostor Syndrome</em></div>
    <div class="category-buttons">
        <span class="btn-chat">AI Chat</span>
        <span class="btn-articles">Articles</span>
    </div>
    <div class="category-description">
        A psychological pattern where individuals doubt their abilities and fear being exposed as frauds.
    </div>
</div>

<div class="subtitle">
    <a href="#" class="btn-articles">Go to the full category list</a>
</div>
@endsection

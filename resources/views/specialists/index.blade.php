@extends('layouts.app')

@section('styles')
<style>
    .specialists-container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 2rem;
        background-color: #FCEBDC;
        border-radius: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .page-header {
        text-align: center;
        margin-bottom: 3rem;
        padding-bottom: 1rem;
        border-bottom: 2px dashed #81AD74;
    }

    .page-title {
        font-size: 2.5rem;
        color: #403540;
        font-weight: bold;
        margin-bottom: 1rem;
    }

    .page-description {
        color: #666;
        font-size: 1.1rem;
    }

    .specialists-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 2rem;
        padding: 1rem;
    }

    .specialist-card {
        background-color: white;
        border-radius: 15px;
        overflow: hidden;
        transition: transform 0.3s ease;
        border: 1px solid #E2E8F0;
    }

    .specialist-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(129, 173, 116, 0.2);
    }

    .specialist-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-bottom: 3px solid #81AD74;
    }

    .specialist-info {
        padding: 1.5rem;
        text-align: right;
    }

    .specialist-name {
        font-size: 1.5rem;
        color: #403540;
        font-weight: bold;
        margin-bottom: 0.5rem;
    }

    .specialist-title {
        color: #81AD74;
        font-size: 1.1rem;
        margin-bottom: 1rem;
    }

    .specialist-description {
        color: #666;
        margin-bottom: 1.5rem;
        line-height: 1.6;
    }

    .specialist-stats {
        display: flex;
        justify-content: space-between;
        padding: 1rem;
        background-color: #f8f9fa;
        border-top: 1px solid #E2E8F0;
    }

    .stat-item {
        text-align: center;
    }

    .stat-value {
        font-size: 1.2rem;
        font-weight: bold;
        color: #81AD74;
    }

    .stat-label {
        font-size: 0.9rem;
        color: #666;
    }

    .specialist-actions {
        padding: 1rem;
        display: flex;
        gap: 1rem;
        justify-content: center;
    }

    .action-button {
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        text-align: center;
        transition: all 0.3s ease;
    }

    .book-button {
        background-color: #81AD74;
        color: white;
        flex: 2;
    }

    .book-button:hover {
        background-color: #6a8f63;
    }

    .profile-button {
        border: 2px solid #81AD74;
        color: #81AD74;
        flex: 1;
    }

    .profile-button:hover {
        background-color: #81AD74;
        color: white;
    }

    .specialties-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }

    .specialty-tag {
        background-color: #f0f9f0;
        color: #81AD74;
        padding: 0.3rem 0.8rem;
        border-radius: 15px;
        font-size: 0.9rem;
    }

    @media (max-width: 768px) {
        .specialists-container {
            margin: 1rem;
            padding: 1rem;
        }

        .specialists-grid {
            grid-template-columns: 1fr;
        }

        .page-title {
            font-size: 2rem;
        }
    }
</style>
@endsection

@section('content')
<div class="specialists-container">
    <div class="page-header">
        <h1 class="page-title">المختصون النفسيون</h1>
        <p class="page-description">نخبة من المختصين النفسيين المؤهلين لمساعدتك</p>
    </div>

    <div class="specialists-grid">
        @foreach($specialists as $specialist)
        <div class="specialist-card">
            <img src="https://ui-avatars.com/api/?name={{ urlencode($specialist->user->name) }}&background=random"  alt="{{ $specialist->user->name }}" class="specialist-image">
            <div class="specialist-info">
                <h2 class="specialist-name">{{ $specialist->user->name }}</h2>
                <h3 class="specialist-title">{{ $specialist->title }}</h3>

                <div class="specialties-tags">
                    @foreach($specialist->specialties as $specialty)
                    <span class="specialty-tag">{{ $specialty->name }}</span>
                    @endforeach
                </div>

                <p class="specialist-description">{{ $specialist->description }}</p>
            </div>

            <div class="specialist-stats">
                <div class="stat-item">
                    <div class="stat-value">{{ $specialist->experience }}+</div>
                    <div class="stat-label">سنوات الخبرة</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">{{ $specialist->sessions->count() }}</div>
                    <div class="stat-label">جلسة</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">{{ $specialist->reviews()->avg('rating') ?? 0 }}</div>
                    <div class="stat-label">التقييم</div>
                </div>
            </div>

            <div class="specialist-actions">
                <a href="{{ route('specialists.book', $specialist->id) }}" class="action-button book-button">
                    حجز موعد
                </a>
                <a href="{{ route('specialists.show', $specialist->id) }}" class="action-button profile-button">
                    الملف الشخصي
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@extends('layouts.app')

@section('styles')
<style>
    .specialist-profile {
        max-width: 1000px;
        margin: 2rem auto;
        padding: 2rem;
        background-color: #FCEBDC;
        border-radius: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .profile-header {
        display: flex;
        gap: 2rem;
        margin-bottom: 2rem;
        padding-bottom: 2rem;
        border-bottom: 2px dashed #81AD74;
    }

    .profile-image {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #81AD74;
    }

    .profile-info {
        flex: 1;
        text-align: right;
    }

    .profile-name {
        font-size: 2rem;
        color: #403540;
        margin-bottom: 0.5rem;
    }

    .profile-title {
        color: #81AD74;
        font-size: 1.2rem;
        margin-bottom: 1rem;
    }

    .profile-stats {
        display: flex;
        gap: 2rem;
        margin-bottom: 1rem;
    }

    .stat {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .stat-icon {
        color: #81AD74;
    }

    .profile-sections {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2rem;
    }

    .section {
        background-color: white;
        padding: 1.5rem;
        border-radius: 10px;
        margin-bottom: 1.5rem;
    }

    .section-title {
        color: #403540;
        font-size: 1.3rem;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #81AD74;
    }

    .availability-calendar {
        background-color: white;
        padding: 1rem;
        border-radius: 10px;
    }

    .calendar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .time-slot {
        padding: 0.5rem;
        margin: 0.25rem;
        border: 1px solid #81AD74;
        border-radius: 5px;
        text-align: center;
        cursor: pointer;
    }

    .time-slot:hover {
        background-color: #81AD74;
        color: white;
    }

    .reviews-section {
        margin-top: 2rem;
    }

    .review-card {
        background-color: white;
        padding: 1rem;
        border-radius: 10px;
        margin-bottom: 1rem;
    }

    .review-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.5rem;
    }

    .review-rating {
        color: #FFD700;
    }

    @media (max-width: 768px) {
        .profile-header {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .profile-sections {
            grid-template-columns: 1fr;
        }

        .profile-stats {
            justify-content: center;
        }
    }
</style>
@endsection

@section('content')
<div class="specialist-profile">
    <div class="profile-header">
        <img src="{{ $specialist->image }}" alt="{{ $specialist->name }}" class="profile-image">
        <div class="profile-info">
            <h1 class="profile-name">{{ $specialist->name }}</h1>
            <h2 class="profile-title">{{ $specialist->title }}</h2>
            
            <div class="profile-stats">
                <div class="stat">
                    <i class="fas fa-star stat-icon"></i>
                    <span>{{ $specialist->rating }} تقييم</span>
                </div>
                <div class="stat">
                    <i class="fas fa-calendar-check stat-icon"></i>
                    <span>{{ $specialist->experience }}+ سنوات خبرة</span>
                </div>
                <div class="stat">
                    <i class="fas fa-users stat-icon"></i>
                    <span>{{ $specialist->sessions_count }} جلسة</span>
                </div>
            </div>
        </div>
    </div>

    <div class="profile-sections">
        <div class="main-content">
            <div class="section">
                <h3 class="section-title">نبذة عن المختص</h3>
                <p>{{ $specialist->bio }}</p>
            </div>

            <div class="section">
                <h3 class="section-title">التخصصات</h3>
                <div class="specialties-tags">
                    @foreach($specialist->specialties as $specialty)
                    <span class="specialty-tag">{{ $specialty }}</span>
                    @endforeach
                </div>
            </div>

            <div class="section reviews-section">
                <h3 class="section-title">التقييمات</h3>
                @foreach($specialist->reviews as $review)
                <div class="review-card">
                    <div class="review-header">
                        <span class="review-author">{{ $review->author }}</span>
                        <div class="review-rating">
                            @for($i = 0; $i < $review->rating; $i++)
                                ⭐
                            @endfor
                        </div>
                    </div>
                    <p>{{ $review->content }}</p>
                </div>
                @endforeach
            </div>
        </div>

        <div class="sidebar">
            <div class="section">
                <h3 class="section-title">حجز موعد</h3>
                <div class="availability-calendar">
                    <div class="calendar-header">
                        <button class="prev-week"><i class="fas fa-chevron-left"></i></button>
                        <span>الأسبوع الحالي</span>
                        <button class="next-week"><i class="fas fa-chevron-right"></i></button>
                    </div>
                  <div class="time-slots">
    @foreach($availableSlots as $slot)
    <div class="time-slot" data-time="{{ $slot->format('Y-m-d H:i:s') }}">
        {{ $slot->format('H:i') }}
    </div>
    @endforeach
</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
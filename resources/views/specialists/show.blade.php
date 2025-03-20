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
            padding: 1.5rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            border: 1px solid #e5e7eb;
        }

        .review-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .reviewer-info {
            display: flex;
            align-items: center;
        }

        .review-author {
            display: block;
            margin-bottom: 0.25rem;
        }

        .review-rating {
            display: flex;
            align-items: center;
        }

        .review-content {
            line-height: 1.6;
        }

        .specialist-response {
            position: relative;
            margin-top: 1rem;
            padding: 1rem;
            background-color: #f8fafc;
            border-right: 3px solid #81AD74;
        }

        .review-card:hover {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
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
            <img src="https://ui-avatars.com/api/?name={{ urlencode($specialist->user->name) }}&background=random"
                alt="{{ $specialist->user->name }}" class="profile-image">
            <div class="profile-info">
                <h1 class="profile-name">{{ $specialist->user->name }}</h1>
                <h2 class="profile-title">{{ $specialist->title }}</h2>

                <div class="profile-stats">
                    <div class="stat">
                        <i class="fas fa-star stat-icon"></i>
                        <span>{{ $specialist->reviews()->avg('rating') ?? 0 }} تقييم</span>
                    </div>
                    <div class="stat">
                        <i class="fas fa-calendar-check stat-icon"></i>
                        <span>{{ $specialist->experience }}+ سنوات خبرة</span>
                    </div>
                    <div class="stat">
                        <i class="fas fa-users stat-icon"></i>
                        <span>{{ $specialist->sessions->count() }} جلسة</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="profile-sections">
            <div class="main-content">
                <div class="section">
                    <h3 class="section-title">نبذة عن المختص</h3>
                    <p>{{ $specialist->description }}</p>
                </div>

                <div class="section">
                    <h3 class="section-title">التخصصات</h3>
                    <div class="specialties-tags">
                        @foreach ($specialist->specialties as $specialty)
                            <span class="specialty-tag">
                                <a href="{{ route('Specialist.specialty', $specialty->id) }}">
                                {{ $specialty->name }}
                                </a>
                            </span>
                        @endforeach
                    </div>
                </div>

                <div class="section reviews-section">
                    <h3 class="section-title">التقييمات</h3>
                    <div class="reviews-container max-h-[40vh] overflow-y-scroll">
                    @if ($specialist->reviews->count() > 0)
                        @foreach ($specialist->reviews as $review)
                            <div class="review-card hover:shadow-lg transition-shadow duration-300">
                                <div class="review-header">
                                    <div class="reviewer-info">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($review->user->name) }}&size=40"
                                            alt="{{ $review->user->name }}" class="w-10 h-10 rounded-full inline-block">
                                        <div class="ml-3 inline-block">
                                            <span
                                                class="review-author font-semibold text-gray-800">{{ $review->user->name }}</span>
                                            <div class="text-sm text-gray-500">
                                                {{ $review->created_at->diffForHumans() }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="review-rating">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $review->rating)
                                                <i class="fas fa-star text-yellow-400"></i>
                                            @else
                                                <i class="far fa-star text-gray-300"></i>
                                            @endif
                                        @endfor
                                        <span class="ml-2 text-sm text-gray-600">({{ $review->rating }}/5)</span>
                                    </div>
                                </div>
                                <div class="review-content mt-4">
                                    <p class="text-gray-700 leading-relaxed">{{ $review->content }}</p>
                                </div>
                                @if ($review->response)
                                    <div class="specialist-response mt-3 bg-gray-50 p-4 rounded-lg">
                                        <div class="flex items-center mb-2">
                                            <i class="fas fa-reply text-green-600 mr-2"></i>
                                            <span class="font-semibold text-green-600">رد المختص</span>
                                        </div>
                                        <p class="text-gray-600">{{ $review->response }}</p>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-8 bg-gray-50 rounded-lg">
                            <i class="far fa-comment-dots text-4xl text-gray-400 mb-3"></i>
                            <p class="text-gray-500">لا توجد تقييمات حتى الآن</p>
                        </div>
                    @endif
                    </div>
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
                        <div class="time-slots max-h-[41vh] overflow-y-scroll">
                            @foreach ($availableSlots as $slot)
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
    <div class="add-review-section bg-white rounded-lg shadow p-6 mb-6">
        <h3 class="text-xl font-semibold mb-4">إضافة تقييم</h3>

        @auth
            <form action="{{ route('specialists.reviews.store', $specialist) }}" method="POST" id="reviewForm">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">التقييم</label>
                    <div class="rating-input flex gap-2">
                        @for ($i = 1; $i <= 5; $i++)
                            <label class="cursor-pointer">
                                <input type="radio" name="rating" value="{{ $i }}" class="hidden" required>
                                <i class="far fa-star text-2xl text-gray-400 hover:text-yellow-400 transition-colors"></i>
                            </label>
                        @endfor
                    </div>
                </div>

                <div class="mb-4">
                    <label for="content" class="block text-gray-700 mb-2">تعليقك</label>
                    <textarea id="content" name="content" rows="4"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required
                        placeholder="اكتب تجربتك مع المختص هنا..."></textarea>
                </div>

                <button type="submit"
                    class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-colors">
                    إرسال التقييم
                </button>
            </form>
        @else
            <div class="text-center py-4 bg-gray-50 rounded-lg">
                <p class="text-gray-600">يرجى <a href="{{ route('login') }}" class="text-green-600 hover:underline">تسجيل
                        الدخول</a> لإضافة تقييم</p>
            </div>
        @endauth
    </div>
@endsection

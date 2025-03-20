@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-lg p-6">
        <div class="flex items-center mb-6">
            <img src="https://ui-avatars.com/api/?name={{ urlencode($specialist->user->name) }}&background=random"
                alt="{{ $specialist->user->name }}"class="w-20 h-20 rounded-full object-cover">
            <div class="mr-4">
                <h1 class="text-2xl font-bold text-gray-800">حجز موعد مع {{ $specialist->user->name }}</h1>
                {{-- <p class="text-gray-600">{{ $specialist->user->title }}</p> --}}
            </div>
        </div>

        <form action="{{ route('specialists.storeBooking', $specialist) }}" method="POST" class="space-y-6">
            @csrf

            <!-- التاريخ -->
            <div>
                <label for="date" class="block text-gray-700 font-medium mb-2">اختر التاريخ</label>
                <input type="date"
                       id="date"
                       name="date"
                       min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                       class="w-full border-2 border-gray-300 p-3 rounded-lg focus:outline-none focus:border-green-500"
                       required>
            </div>

            <!-- الوقت -->
            <div>
                <label for="time" class="block text-gray-700 font-medium mb-2">اختر الوقت</label>
                <select id="time"
                        name="time"
                        class="w-full border-2 border-gray-300 p-3 rounded-lg focus:outline-none focus:border-green-500"
                        required>
                    <option value="">اختر وقت مناسباً</option>
                    @for ($hour = 9; $hour <= 20; $hour++)
                        <option value="{{ sprintf('%02d:00', $hour) }}">{{ sprintf('%02d:00', $hour) }}</option>
                    @endfor
                </select>
            </div>

            <!-- نوع الجلسة -->
            <div>
                <label class="block text-gray-700 font-medium mb-2">نوع الجلسة</label>
                <div class="flex gap-4">
                    <label class="flex items-center">
                        <input type="radio"
                               name="type"
                               value="online"
                               class="ml-2"
                               required>
                        <span>عن بعد</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio"
                               name="type"
                               value="in-person"
                               class="ml-2"
                               required>
                        <span>حضوري</span>
                    </label>
                </div>
            </div>

            <!-- ملاحظات -->
            <div>
                <label for="notes" class="block text-gray-700 font-medium mb-2">ملاحظات إضافية</label>
                <textarea id="notes"
                          name="notes"
                          rows="4"
                          class="w-full border-2 border-gray-300 p-3 rounded-lg focus:outline-none focus:border-green-500"
                          placeholder="اكتب أي ملاحظات إضافية هنا..."></textarea>
            </div>

            <!-- معلومات التكلفة -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="font-bold text-gray-800 mb-2">تكلفة الجلسة</h3>
                <p class="text-gray-600">{{ $specialist->cost }} دولار</p>
            </div>

            @if ($errors->any())
                <div class="bg-red-50 text-red-500 p-4 rounded-lg">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- زر الحجز -->
            <button type="submit" disabled
                    class="w-full bg-green-600 text-white py-3 px-6 rounded-lg hover:bg-green-700 transition duration-200 cursor-not-allowed">
                تأكيد الحجز
            </button>
        </form>
    </div>
</div>
@endsection

@section('styles')
<style>
    input[type="date"]::-webkit-calendar-picker-indicator {
        filter: invert(0.5);
    }
</style>
@endsection

@extends('layouts.app')


@section('content')

 <div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-900 text-center mb-8">تصفح مجموعة متنوعة من الاضطرابات النفسية للبدء</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Anxiety -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">القلق</h2>
            <p class="text-gray-700 mb-4">حالة صحية نفسية تتميز بقلق أو خوف أو توتر مفرط. يمكن أن تظهر جسديًا (مثل التعرق، تسارع ضربات القلب) وذهنيًا (مثل الأفكار المتطفلة)، وغالبًا ما تتداخل مع الحياة اليومية.</p>
            <div class="flex space-x-4">
                <a href="#" class="text-blue-500 hover:text-blue-700">الدردشة بالذكاء الاصطناعي</a>
                <a href="#" class="text-blue-500 hover:text-blue-700">مقالات</a>
            </div>
        </div>

        <!-- Depression -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">الاكتئاب</h2>
            <p class="text-gray-700 mb-4">اضطراب مزاجي يتميز بمشاعر مستمرة من الحزن واليأس وفقدان الاهتمام بالأنشطة التي كانت ممتعة. يمكن أن يؤثر على النوم والشهية والطاقة والأداء العام.</p>
            <div class="flex space-x-4">
                <a href="#" class="text-blue-500 hover:text-blue-700">الدردشة بالذكاء الاصطناعي</a>
                <a href="#" class="text-blue-500 hover:text-blue-700">مقالات</a>
            </div>
        </div>

        <!-- Burnout -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">الإرهاق</h2>
            <p class="text-gray-700 mb-4">حالة من الإرهاق العاطفي والجسدي والعقلي الناجم عن الإجهاد المطول، غالبًا ما يكون مرتبطًا بالعمل. تشمل الأعراض التعب والانفصال وانخفاض الفعالية.</p>
            <div class="flex space-x-4">
                <a href="#" class="text-blue-500 hover:text-blue-700">الدردشة بالذكاء الاصطناعي</a>
                <a href="#" class="text-blue-500 hover:text-blue-700">مقالات</a>
            </div>
        </div>

        <!-- Impostor Syndrome -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">متلازمة المحتال</h2>
            <p class="text-gray-700 mb-4">نمط نفسي يشكك فيه الأفراد في قدراتهم ويخافون من أن يتم الكشف عنهم كـ "محتالين"، على الرغم من وجود أدلة على كفاءتهم وإنجازاتهم.</p>
            <div class="flex space-x-4">
                <a href="#" class="text-blue-500 hover:text-blue-700">الدردشة بالذكاء الاصطناعي</a>
                <a href="#" class="text-blue-500 hover:text-blue-700">مقالات</a>
            </div>
        </div>
    </div>

    <div class="text-center mt-8">
        <a href="#" class="text-blue-500 hover:text-blue-700">تصفح القائمة الكاملة</a>
    </div>
</div>


@endsection("content")


{{--  --}}

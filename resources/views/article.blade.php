@extends('layouts.app')

@section('styles')
<style>
    .subtitle {
        font-size: 22px;
        color: #403540;
        line-height: 1.5;
        margin-bottom: 20px;
        text-align: center;
        margin-top: 80px;
    }

    .article-section {
        text-align: left;
        width: 60%;
        margin: 30px auto;
        padding: 20px 25px;
        border-radius: 10px;
        border-bottom: 2px dashed #5E875E;
        transition: transform 0.2s;
        background-color: white;
    }

    .article-section:hover {
        transform: translateY(-5px);
        background-color: #FCEBD4;
    }

    .article-title {
        font-size: 24px;
        font-weight: bold;
        color: #403540;
        margin-bottom: 10px;
    }

    .article-buttons {
        display: flex;
        gap: 10px;
        margin: 15px 0;
    }

    .btn-chat, .btn-articles {
        padding: 8px 16px;
        border-radius: 20px;
        cursor: pointer;
        font-size: 14px;
        transition: all 0.2s;
    }

    .btn-chat {
        background-color: #5E875E;
        color: white;
    }

    .btn-chat:hover {
        background-color: #4a694a;
    }

    .btn-articles {
        border: 2px solid #5E875E;
        color: #5E875E;
    }

    .btn-articles:hover {
        background-color: #5E875E;
        color: white;
    }

    .article-description {
        font-size: 16px;
        color: #403540;
        margin-top: 10px;
    }

    .arrow {
        font-size: 24px;
        margin-top: 10px;
        color: #5E875E;
    }
</style>
@endsection

@section('content')
<div class="subtitle">
    تصفح مجموعة متنوعة من الاضطرابات النفسية للبدء
    <div class="arrow">↓</div>
</div>

<div class="article-section">
    <div class="article-title"><em>القلق</em></div>
    <div class="article-buttons">
        <a href="{{ route('chat') }}" class="btn-chat">الدردشة مع الذكاء الاصطناعي</a>
        <a href="#" class="btn-articles">المقالات</a>
    </div>
    <div class="article-description">
        حالة صحية نفسية تتميز بقلق أو خوف أو توتر مفرط. يمكن أن تظهر جسديًا (مثل التعرق، تسارع ضربات القلب) وذهنيًا (مثل الأفكار المتطفلة)، وغالبًا ما تتداخل مع الحياة اليومية.
    </div>
</div>

<div class="article-section">
    <div class="article-title"><em>الاكتئاب</em></div>
    <div class="article-buttons">
        <a href="{{ route('chat') }}" class="btn-chat">الدردشة مع الذكاء الاصطناعي</a>
        <a href="#" class="btn-articles">المقالات</a>
    </div>
    <div class="article-description">
        اضطراب مزاجي يتميز بمشاعر مستمرة من الحزن واليأس وفقدان الاهتمام بالأنشطة التي كانت ممتعة. يمكن أن يؤثر على النوم والشهية والطاقة والأداء العام.
    </div>
</div>

<div class="article-section">
    <div class="article-title"><em>الإرهاق</em></div>
    <div class="article-buttons">
        <a href="{{ route('chat') }}" class="btn-chat">الدردشة مع الذكاء الاصطناعي</a>
        <a href="#" class="btn-articles">المقالات</a>
    </div>
    <div class="article-description">
        حالة من الإرهاق العاطفي والجسدي والعقلي الناجم عن الإجهاد المطول، غالبًا ما يكون مرتبطًا بالعمل. تشمل الأعراض التعب والانفصال وانخفاض الفعالية.
    </div>
</div>

<div class="article-section">
    <div class="article-title"><em>متلازمة المحتال</em></div>
    <div class="article-buttons">
        <a href="{{ route('chat') }}" class="btn-chat">الدردشة مع الذكاء الاصطناعي</a>
        <a href="#" class="btn-articles">المقالات</a>
    </div>
    <div class="article-description">
        نمط نفسي يشكك فيه الأفراد في قدراتهم ويخافون من أن يتم الكشف عنهم كـ "محتالين"، على الرغم من وجود أدلة على كفاءتهم وإنجازاتهم.
    </div>
</div>
@endsection

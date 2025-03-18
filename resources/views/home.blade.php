@extends('layouts.app')

@section('styles')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Courier+Prime:ital,wght@1,700&display=swap');

        .logo {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }

        .logo img {
            width: 200px;
            /* ضبط حجم الشعار */
            height: auto;
        }

        .subtitle {
            font-size: 22px;
            color: #403540;
            line-height: 1.5;
            margin-bottom: 20px;
            text-align: center;
            margin-top: 80px;
        }

        .subtitle strong {
            font-weight: bold;
        }

        .container {
            border: 2px solid #5E875E;
            display: flex;
            justify-content: space-between;
            gap: 20px;
            padding: 20px;
            margin: 30px auto;
            width: fit-content;
            border-radius: 10px;
        }

        .box {
            width: 180px;
            height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            font-size: 20px;
            font-style: italic;
            font-weight: bold;
            text-align: center;
        }

        .box:first-child {
            background-color: #5E875E;
            color: white;
        }

        .box:last-child {
            border: 2px solid #5E875E;
            color: #5E875E;
            background-color: transparent;
        }

        .box:first-child:hover {
            border: 2px solid #5E875E;
            color: #5E875E;
            background-color: transparent;
        }

        .box:last-child:hover {
            background-color: #5E875E;
            color: white;
        }

        .arrow {
            font-size: 24px;
            color: black;
            margin-top: 10px;
        }

        /* category */


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

        .btn-chat,
        .btn-articles {
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
    <div class="min-h-screen flex flex-col justify-center items-center">

        <div class="w-full max-w-4xl px-4">
            <div class="flex justify-center items-center gap-8 mb-12">
                <div class="logo">
                    <img src="{{ asset('logo_1.svg') }}" alt="Psych AI Logo">
                </div>

                <div class="subtitle text-left">
                    Your mental health AI companion, <br>
                    <em>through <strong>thick & thin</strong>.</em>
                </div>
            </div>

            <div class="container mx-auto">
                <a href="{{ route('chat') }}">
                    <div class="box">
                        Talk with AI</div>
                </a>
                <a href="#category">
                    <div class="box">
                        View Categories
                    </div>
                </a>
            </div>


        </div>
        <div class="mt-30">
            <div id="category">
                @include('category', ['categories' => $categories])
            </div>
        </div>
    </div>
@endsection

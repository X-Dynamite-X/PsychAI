@extends("layouts.app")

@section("styles")
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
        }

        .subtitle strong {
            font-weight: bold;
        }

        .container {
            border: 2px solid #5E875E;
            display: flex;
            justify-content: center;
            gap: 20px;
            padding: 20px;
            margin: 30px auto;
            width: 50%;
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

        .arrow {
            font-size: 24px;
            color: black;
            margin-top: 10px;
        }
    </style>
@endsection

@section("content")

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
            <div class="box">Talk with AI</div>
            <div class="box">View Categories</div>
        </div>

        <div class="arrow mt-6">&#8595;</div>
    </div>
</div>

@endsection

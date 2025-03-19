<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Psych AI</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('logo_1.svg') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">

    @include('layouts.sidebar')
    <div class="p-4 sm:ml-64">
        @yield('content')
        @yield('loding')

        <div id="models">
        @yield('models')
        </div>
    </div>

    </div>
    @yield('script')
</body>


</html>

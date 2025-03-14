<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TechBlog</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Courier+Prime:ital,wght@1,700&display=swap');

        body {
            background-color: #FCEBDC;
            font-family: 'Courier Prime', monospace;
            text-align: center;
            padding: 50px;
        }

        /* Navigation Styles */
        nav {
            background-color: #FCEBDC;
            backdrop-filter: blur(8px);
            /* box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1); */
            /* position: fixed; */
            width: 100%;
            top: 0;
            z-index: 50;
        }

        .nav-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .nav-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 64px;
        }

        .logo-section img {
            height: 48px;
            width: auto;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
        }

        .nav-link {
            color: #374151;
            padding: 0.5rem 0.75rem;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            transition: color 0.2s;
        }

        .nav-link:hover {
            color: #059669;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
        }

        .mobile-menu-button {
            display: none;
        }

        /* Mobile Menu */
        .mobile-menu {
            display: none;
            padding: 1rem;
        }

        .mobile-menu a {
            display: block;
            padding: 0.75rem;
            color: #374151;
            text-decoration: none;
            font-weight: 500;
        }

        /* Existing Styles */
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

        .btn-primary {
            background-color: #059669;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            transition: background-color 0.2s;
        }

        .btn-primary:hover {
            background-color: #047857;
        }

        .btn-secondary {
            border: 2px solid #059669;
            color: #059669;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-secondary:hover {
            background-color: #059669;
            color: white;
        }

        @media (max-width: 768px) {

            .nav-links,
            .action-buttons {
                display: none;
            }

            .mobile-menu-button {
                display: block;
            }

            .mobile-menu.active {
                display: block;
            }

            .category-section {
                width: 90%;
            }
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


    @yield('styles')
</head>

{{-- <body class="bg-gray-50  dark:bg-black"> --}}

<body class=" ">


    @include('layouts.nav')

    @yield('content')

</body>
@yield('script')

<script></script>

</html>

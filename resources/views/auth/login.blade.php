@extends('layouts.app')


@section('content')
    <div class="min-h-screen flex items-center justify-center p-4" style="background-color: #FCEBDC;">
        <div class="max-w-md w-full">
            <!-- Logo Container -->
            <div class="text-center mb-8">
                <img src="{{ asset('logo_1.svg') }}" alt="Logo" class="mx-auto h-20 w-auto mb-4">
                <h2 class="text-4xl font-bold text-green-800 mb-2">Welcome Back!</h2>
                <p class="text-green-700/80">Please sign in to your account</p>
            </div>

            <!-- Login Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border-2 border-green-800">
                <div class="p-8">
                    <form id="loginForm" class="space-y-6">
                        @csrf

                        <!-- Email Field -->
                        <div class="space-y-2">
                            <label for="email" class="block text-sm font-medium text-green-800">
                                Email Address
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-green-600"></i>
                                </div>
                                <input id="email" name="email" type="email" required
                                    class="block w-full pl-10 pr-3 py-2.5 border border-green-300 rounded-lg
                                    focus:ring-2 focus:ring-green-500 focus:border-green-500
                                    bg-green-50 text-green-800 text-sm"
                                    placeholder="your@email.com">
                            </div>
                        </div>

                        <!-- Password Field -->
                        <div class="space-y-2">
                            <label for="password" class="block text-sm font-medium text-green-800">
                                Password
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-green-600"></i>
                                </div>
                                <input id="password" name="password" type="password" required
                                    class="block w-full pl-10 pr-10 py-2.5 border border-green-300 rounded-lg
                                    focus:ring-2 focus:ring-green-500 focus:border-green-500
                                    bg-green-50 text-green-800 text-sm"
                                    placeholder="••••••••">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <button type="button" id="togglePassword" class="text-green-600 hover:text-green-700">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember" name="remember" type="checkbox"
                                    class="h-4 w-4 text-green-600 focus:ring-green-500 border-green-300 rounded">
                                <label for="remember" class="ml-2 block text-sm text-green-700">
                                    Remember me
                                </label>
                            </div>
                            <a href="{{ route('password.request') }}"
                                class="text-sm font-medium text-green-600 hover:text-green-700">
                                Forgot password?
                            </a>
                        </div>

                        <!-- Login Button -->
                        <div>
                            <button type="submit"
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg
                                text-sm font-medium text-white bg-green-700 hover:bg-green-800
                                focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500
                                transition duration-150 ease-in-out">
                                <span class="flex items-center">
                                    <span class="mr-2">Sign in</span>
                                    <i class="fas fa-arrow-right"></i>
                                </span>
                            </button>
                        </div>

                        <!-- Error Message -->
                        <div id="errorMessage" class="hidden">
                            <div class="bg-red-50 text-red-500 p-3 rounded-lg text-sm">
                                <div class="flex">
                                    <i class="fas fa-exclamation-circle mr-2 mt-0.5"></i>
                                    <span class="error-text"></span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Footer -->
                <div class="px-8 py-4 bg-green-50 border-t border-green-100">
                    <p class="text-sm text-center text-green-700">
                        Don't have an account?
                        <a href="{{ route('register') }}"
                            class="font-medium text-green-600 hover:text-green-700">
                            Create one now
                        </a>
                    </p>
                </div>
            </div>

            <!-- Social Login -->
          
               
            </div>
        </div>
    </div>
@endsection('content')


@section('style')
    <style>
        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-5px);
            }

            75% {
                transform: translateX(5px);
            }
        }

        .animate-shake {
            animation: shake 0.5s cubic-bezier(.36, .07, .19, .97) both;
        }
    </style>
@endsection("style")

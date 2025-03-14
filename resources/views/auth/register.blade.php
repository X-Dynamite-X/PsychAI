@extends('layouts.app')


@section('content')
    <div class="min-h-screen flex items-center justify-center p-4" style="background-color: #FCEBDC;">
        <div class="max-w-md w-full">
            <!-- Logo Container -->
            <div class="text-center mb-8">
                <img src="{{ asset('logo_1.svg') }}" alt="Logo" class="mx-auto h-20 w-auto mb-4">
                <h2 class="text-4xl font-bold text-green-800 mb-2">Create Account</h2>
                <p class="text-green-700/80">Join our community today</p>
            </div>

            <!-- Register Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border-2 border-green-800">
                <div class="p-8">
                    <form id="registerForm" class="space-y-6">
                        @csrf

                        <!-- Full Name Fields -->
                        <div class="space-y-2">
                            <label for="name" class="block text-sm font-medium text-green-800">
                                Name
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user text-green-600"></i>
                                </div>
                                <input id="name" name="name" type="text" required
                                    class="block w-full pl-10 pr-3 py-2.5 border border-green-300 rounded-lg
                                    focus:ring-2 focus:ring-green-500 focus:border-green-500
                                    bg-green-50 text-green-800 text-sm"
                                    placeholder="your name">
                            </div>
                        </div>

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

                        <!-- Confirm Password Field -->
                        <div class="space-y-2">
                            <label for="passwordConfirmation" class="block text-sm font-medium text-green-800">
                                Confirm Password
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-green-600"></i>
                                </div>
                                <input id="passwordConfirmation" name="password_confirmation" type="password" required
                                    class="block w-full pl-10 pr-10 py-2.5 border border-green-300 rounded-lg
                                    focus:ring-2 focus:ring-green-500 focus:border-green-500
                                    bg-green-50 text-green-800 text-sm"
                                    placeholder="••••••••">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <button type="button" id="togglePasswordConfirmation"
                                        class="text-green-600 hover:text-green-700">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Register Button -->
                        <div>
                            <button type="submit"
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg
                                text-sm font-medium text-white bg-green-700 hover:bg-green-800
                                focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500
                                transition duration-150 ease-in-out">
                                <span class="flex items-center">
                                    <span class="mr-2">Create Account</span>
                                    <i class="fas fa-user-plus"></i>
                                </span>
                            </button>
                        </div>

                        <!-- Error Message -->
                        <div id="errorMessage" class="hidden">
                            <div class="bg-red-50 text-red-500 p-3 rounded-lg text-sm">
                                <div class="flex">
                                    <i class="fas fa-exclamation-circle mr-2 mt-0.5"></i>
                                    <span id="error_text" class="error-text"></span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Footer -->
                <div class="px-8 py-4 bg-green-50 border-t border-green-100">
                    <p class="text-sm text-center text-green-700">
                        Already have an account?
                        <a href="{{ route('login') }}" class="font-medium text-green-600 hover:text-green-700">
                            Sign in here
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection('content')

@extends('layouts.app')


@section('content')
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="max-w-md w-full">
            <!-- Logo Container -->
            <div class="text-center mb-8">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="mx-auto h-16 w-auto mb-4">
                <h2 class="text-4xl font-bold text-white mb-2">Create Account</h2>
                <p class="text-white/80">Join our community today</p>
            </div>

            <!-- Register Card -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
                <div class="p-8">
                    <form id="registerForm" class="space-y-6">
                        @csrf

                        <!-- Full Name Fields -->


                        <div class="space-y-2">
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Name
                            </label>
                            <div class="relative">
                                <input id="name" name="name" type="text" required
                                    class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg
                                    focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                                    dark:bg-gray-700 dark:text-white text-sm"
                                    placeholder="your name">
                            </div>
                        </div>


                        <!-- Email Field -->
                        <div class="space-y-2">
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Email Address
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-gray-400"></i>
                                </div>
                                <input id="email" name="email" type="email" required
                                    class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg
                                focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                                dark:bg-gray-700 dark:text-white text-sm"
                                    placeholder="your@email.com">
                            </div>
                        </div>

                        <!-- Password Field -->
                        <div class="space-y-2">
                            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Password
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
                                <input id="password" name="password" type="password" required
                                    class="block w-full pl-10 pr-10 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg
                                focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                                dark:bg-gray-700 dark:text-white text-sm"
                                    placeholder="••••••••">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <button type="button" id="togglePassword" class="text-gray-400 hover:text-gray-500">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Confirm Password Field -->
                        <div class="space-y-2">
                            <label for="passwordConfirmation"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Confirm Password
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
                                <input id="passwordConfirmation" name="password_confirmation" type="password" required
                                    class="block w-full pl-10 pr-10 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg
                                focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                                dark:bg-gray-700 dark:text-white text-sm"
                                    placeholder="••••••••">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <button type="button" id="togglePasswordConfirmation"
                                        class="text-gray-400 hover:text-gray-500">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>




                        <!-- Register Button -->
                        <div>
                            <button type="submit"
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg
                            text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700
                            focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500
                            transition duration-150 ease-in-out">
                                <span class="flex items-center">
                                    <span class="mr-2">Create Account</span>
                                    <i class="fas fa-user-plus"></i>
                                </span>
                            </button>
                        </div>

                        <!-- Error Message -->
                        <div id="errorMessage" class="hidden">
                            <div class="bg-red-50 dark:bg-red-900/50 text-red-500 dark:text-red-400 p-3 rounded-lg text-sm">
                                <div class="flex">
                                    <i class="fas fa-exclamation-circle mr-2 mt-0.5"></i>
                                    <span id="error_text" class="error-text"></span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Footer -->
                <div class="px-8 py-4 bg-gray-50 dark:bg-gray-700/50 border-t border-gray-100 dark:border-gray-700">
                    <p class="text-sm text-center text-gray-600 dark:text-gray-400">
                        Already have an account?
                        <a href="{{ route('login') }}"
                            class="font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400">
                            Sign in here
                        </a>
                    </p>
                </div>
            </div>

            <!-- Social Register -->
            <div class="mt-6">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-white/20"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 text-white bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500">
                            Or register with
                        </span>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-3 gap-3">
                    <button
                        class="w-full inline-flex justify-center py-2 px-4 border border-white/20 rounded-lg
                    bg-white/10 hover:bg-white/20 text-white transition duration-150 ease-in-out">
                        <i class="fab fa-google"></i>
                    </button>
                    <button
                        class="w-full inline-flex justify-center py-2 px-4 border border-white/20 rounded-lg
                    bg-white/10 hover:bg-white/20 text-white transition duration-150 ease-in-out">
                        <i class="fab fa-facebook-f"></i>
                    </button>
                    <button
                        class="w-full inline-flex justify-center py-2 px-4 border border-white/20 rounded-lg
                    bg-white/10 hover:bg-white/20 text-white transition duration-150 ease-in-out">
                        <i class="fab fa-github"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection('content')

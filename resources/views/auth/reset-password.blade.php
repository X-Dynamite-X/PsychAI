@extends("layouts.app")
@section('content')
<div class="min-h-screen flex items-center justify-center p-4" style="background-color: #FCEBDC;">
    <div class="max-w-md w-full">
        <!-- Logo Container -->
        <div class="text-center mb-8">
            <img src="{{ asset('logo_1.svg') }}" alt="Logo" class="mx-auto h-20 w-auto mb-4">
            <h2 class="text-4xl font-bold text-green-800 mb-2">Reset Password</h2>
            <p class="text-green-700/80">Enter your new password</p>
        </div>

        <!-- Reset Password Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border-2 border-green-800">
            <div class="p-8">
                <form id="resetPasswordForm" class="space-y-6">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <!-- Email Field -->
                    <div class="space-y-2">
                        <label id="email" data-email="{{ request()->email }}" class="block text-sm font-medium text-gray-700">{{ request()->email }}</label>

                    </div>

                    <!-- Password Field -->
                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
                        <input type="password" id="password" name="password"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500"
                            required>
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="space-y-2">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500"
                            required>
                    </div>

                    <!-- Reset Button -->
                    <div>
                        <button type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg
                            text-sm font-medium text-white bg-green-700 hover:bg-green-800
                            focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500
                            transition duration-150 ease-in-out">
                            <span class="flex items-center">
                                <span class="mr-2">Reset Password</span>
                                <i class="fas fa-key"></i>
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
                    Remember your password?
                    <a href="{{ route('login') }}" class="font-medium text-green-600 hover:text-green-700">
                        Back to login
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>


@endsection

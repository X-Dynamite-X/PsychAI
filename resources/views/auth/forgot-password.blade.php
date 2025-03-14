@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex items-center justify-center p-4" style="background-color: #FCEBDC;">
        <div class="max-w-md w-full">
            <!-- Logo Container -->
            <div class="text-center mb-8">
                <img src="{{ asset('logo_1.svg') }}" alt="Logo" class="mx-auto h-20 w-auto mb-4">
                <h2 class="text-4xl font-bold text-green-800 mb-2">Forgot Password?</h2>
                <p class="text-green-700/80">Enter your email to reset your password</p>
            </div>

            <!-- Forgot Password Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border-2 border-green-800">
                <div class="p-8">
                    <form id="forgotPasswordForm" class="space-y-6">
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

                        <!-- Submit Button -->
                        <div>
                            <button type="submit"
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg
                                text-sm font-medium text-white bg-green-700 hover:bg-green-800
                                focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500
                                transition duration-150 ease-in-out">
                                <span class="flex items-center">
                                    <span class="mr-2">Send Reset Link</span>
                                    <i class="fas fa-paper-plane"></i>
                                </span>
                            </button>
                        </div>

                        <!-- Success Message -->
                        <div id="successMessage" class="hidden">
                            <div class="bg-green-50 text-green-600 p-3 rounded-lg text-sm">
                                <div class="flex">
                                    <i class="fas fa-check-circle mr-2 mt-0.5"></i>
                                    <span>Password reset link has been sent to your email.</span>
                                </div>
                            </div>
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

    @push('scripts')
    <script>
        document.getElementById('forgotPasswordForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const submitButton = this.querySelector('button[type="submit"]');
            const originalContent = submitButton.innerHTML;
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            submitButton.disabled = true;
            
            const errorMessage = document.getElementById('errorMessage');
            const successMessage = document.getElementById('successMessage');
            const errorText = errorMessage.querySelector('.error-text');
            
            fetch('{{ route("password.email") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    email: document.getElementById('email').value
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    errorMessage.classList.add('hidden');
                    successMessage.classList.remove('hidden');
                    submitButton.innerHTML = '<i class="fas fa-check"></i>';
                } else {
                    throw new Error(data.message || 'An error occurred');
                }
            })
            .catch(error => {
                errorText.textContent = error.message;
                errorMessage.classList.remove('hidden');
                successMessage.classList.add('hidden');
                submitButton.innerHTML = originalContent;
                submitButton.disabled = false;
            });
        });
    </script>
    @endpush
@endsection
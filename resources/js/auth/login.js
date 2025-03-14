import $ from 'jquery';

$(document).ready(function() {
    // Toggle Password Visibility
    $('#togglePassword').on('click', function() {
        const passwordInput = $('#password');
        const icon = $(this).find('i');

        if (passwordInput.attr('type') === 'password') {
            passwordInput.attr('type', 'text');
            icon.removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            passwordInput.attr('type', 'password');
            icon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });

    // Form Submission
    $('#loginForm').on('submit', function(e) {
        e.preventDefault();

        // Add loading state to button
        const submitButton = $(this).find('button[type="submit"]');
        const originalContent = submitButton.html();
        submitButton.html('<i class="fas fa-spinner fa-spin"></i>').prop('disabled', true);

        $.ajax({
            url: '/login',
            type: 'POST',
            data: {
                email: $('#email').val(),
                password: $('#password').val(),
                remember: $('#remember').is(':checked'),
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    // Add success animation before redirect
                    submitButton.html('<i class="fas fa-check"></i>');
                    setTimeout(() => {
                        window.location.href = response.redirect;
                    }, 500);
                }
            },
            error: function(xhr) {
                const response = xhr.responseJSON;
                $('#errorMessage')
                    .removeClass('hidden')
                    .find('.error-text')
                    .text(response.message || 'An error occurred');

                // Shake animation for error
                $('#errorMessage').addClass('animate-shake');
                setTimeout(() => {
                    $('#errorMessage').removeClass('animate-shake');
                }, 500);

                // Reset button
                submitButton.html(originalContent).prop('disabled', false);
            }
        });
    });
});

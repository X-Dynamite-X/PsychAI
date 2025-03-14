import $ from 'jquery';

$(document).ready(function() {
    function togglePasswordVisibility(inputId, buttonId) {
        $(buttonId).on('click', function() {
            const input = $(inputId);
            const icon = $(this).find('i');

            if (input.attr('type') === 'password') {
                input.attr('type', 'text');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                input.attr('type', 'password');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
    }

    togglePasswordVisibility('#password', '#togglePassword');
    togglePasswordVisibility('#password_confirmation', '#togglePasswordConfirmation');

    $('#resetPasswordForm').on('submit', function(e) {

        const submitButton = $(this).find('button[type="submit"]');
        const originalContent = submitButton.html();
        submitButton.html('<i class="fas fa-spinner fa-spin"></i>').prop('disabled', true);

        $.ajax({
            url: '{{ route("password.update") }}',
            type: 'POST',
            data: {
                token: $('input[name="token"]').val(),
                email: $('input[name="email"]').val(),
                password: $('#password').val(),
                password_confirmation: $('#password_confirmation').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    submitButton.html('<i class="fas fa-check"></i>');
                    // عرض رسالة النجاح
                    alert(response.message);
                    // إعادة التوجيه إلى صفحة تسجيل الدخول
                    setTimeout(() => {
                        window.location.href = response.redirect;
                    }, 1000);
                }
            },
            error: function(xhr) {
                const response = xhr.responseJSON;
                $('#errorMessage')
                    .removeClass('hidden')
                    .find('.error-text')
                    .text(response.message || 'An error occurred');

                submitButton.html(originalContent).prop('disabled', false);
            }
        });
    });
});

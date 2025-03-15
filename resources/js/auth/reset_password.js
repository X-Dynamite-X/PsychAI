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
        e.preventDefault();

        const submitButton = $(this).find('button[type="submit"]');
        const originalContent = submitButton.html();
        submitButton.html('<i class="fas fa-spinner fa-spin"></i>').prop('disabled', true);

        $.ajax({
            url: '/reset-password',
            type: 'POST',
            data: {
                token: $('input[name="token"]').val(),
                email: $('#email').data("email"),
                password: $('#password').val(),
                password_confirmation: $('#password_confirmation').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    // تغيير أيقونة الزر إلى علامة صح
                    submitButton.html('<i class="fas fa-check"></i>');

                    // إظهار رسالة نجاح
                    const successMessage = response.message || 'تم تغيير كلمة المرور بنجاح';

                    // إضافة تأثير بصري للنجاح
                    $('#successMessage')
                        .removeClass('hidden')
                        .html(`<div class="text-green-600 text-center p-3">
                            <i class="fas fa-check-circle mr-2"></i>${successMessage}
                        </div>`);

                    // إخفاء أي رسائل خطأ سابقة
                    $('#errorMessage').addClass('hidden');

                    // إعادة التوجيه إلى صفحة تسجيل الدخول بعد ثانيتين
                    setTimeout(() => {
                        window.location.href = response.redirect || '/login';
                    }, 2000);
                }
            },
            error: function(xhr) {
                const response = xhr.responseJSON;
                $('#errorMessage')
                    .removeClass('hidden')
                    .find('.error-text')
                    .text(response.message || 'حدث خطأ أثناء تغيير كلمة المرور');

                // إعادة الزر إلى حالته الأصلية
                submitButton.html(originalContent).prop('disabled', false);
            }
        });
    });
});

import $ from 'jquery';

$(document).ready(function() {
    $('#forgotPasswordForm').on('submit', function(e) {
        e.preventDefault();

        const submitButton = $(this).find('button[type="submit"]');
        const originalContent = submitButton.html();
        submitButton.html('<i class="fas fa-spinner fa-spin"></i>').prop('disabled', true);

        $.ajax({
            url: '{{ route("password.email") }}',
            type: 'POST',
            data: {
                email: $('#email').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    $('#errorMessage').addClass('hidden');
                    submitButton.html('<i class="fas fa-check"></i>');
                    alert(response.message);
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

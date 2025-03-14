import $ from "jquery";

$(document).ready(function () {
    // Toggle Password Visibility
    function togglePasswordVisibility(inputId, buttonId) {
        $(buttonId).on("click", function () {
            const input = $(inputId);
            const icon = $(this).find("i");

            if (input.attr("type") === "password") {
                input.attr("type", "text");
                icon.removeClass("fa-eye").addClass("fa-eye-slash");
            } else {
                input.attr("type", "password");
                icon.removeClass("fa-eye-slash").addClass("fa-eye");
            }
        });
    }

    togglePasswordVisibility("#password", "#togglePassword");
    togglePasswordVisibility(
        "#passwordConfirmation",
        "#togglePasswordConfirmation"
    );

    // Form Submission
    $("#registerForm").on("submit", function (e) {
        e.preventDefault();

        // Add loading state to button
        const submitButton = $(this).find('button[type="submit"]');

        const originalContent = submitButton.html();
        submitButton
            .html('<i class="fas fa-spinner fa-spin"></i>')
            .prop("disabled", true);

        // Validate passwords match
        const password = $("#password").val();
        const passwordConfirmation = $("#passwordConfirmation").val();

        if (password !== passwordConfirmation) {
            $("#errorMessage")
                .removeClass("hidden")
                .find(".error-text")
                .text("Passwords do not match");
            submitButton.html(originalContent).prop("disabled", false);
            return;
        }

        $.ajax({
            url: "/register",
            type: "POST",
            data: {
                first_name: $("#firstName").val(),
                name: $("#name").val(),
                email: $("#email").val(),
                password: password,
                password_confirmation: passwordConfirmation,
                terms: $("#terms").is(":checked"),
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.success) {
                    // Add success animation before redirect
                    submitButton.html('<i class="fas fa-check"></i>');
                    setTimeout(() => {
                        window.location.href = response.redirect;
                    }, 500);
                }
            },
            error: function (xhr) {
                const response = xhr.responseJSON;
                const errorContainer = $("#errorMessage");
                const errorText = $("#error_text");

                // Clear previous errors
                errorText.empty();
                errorContainer.removeClass("hidden");

                // Handle different error response formats
                if (response.errors) {
                    // If errors is an object
                    if (typeof response.errors === 'object') {
                        Object.values(response.errors).forEach(errorArray => {
                            if (Array.isArray(errorArray)) {
                                errorArray.forEach(error => {
                                    errorText.append(`<div>${error}</div>`);
                                });
                            }
                        });
                    }
                    // If errors is an array
                    else if (Array.isArray(response.errors)) {
                        response.errors.forEach(error => {
                            errorText.append(`<div>${error}</div>`);
                        });
                    }
                }
                // If there's a single error message
                else if (response.message) {
                    errorText.append(`<div>${response.message}</div>`);
                }

                // Add shake animation
                errorContainer.addClass("animate-shake");
                setTimeout(() => {
                    errorContainer.removeClass("animate-shake");
                }, 500);

                // Reset button state
                submitButton.html(originalContent).prop("disabled", false);
            },
        });
    });
});

import $ from "jquery";

$(document).ready(function () {
    const $ratingInputs = $(".rating-input input");
    const $ratingStars = $(".rating-input i");

    // تحديث شكل النجوم عند التحويم والاختيار
    $ratingInputs.on("change", function () {
        const selectedIndex = $ratingInputs.index(this);
        updateStars(selectedIndex);
    });

    function updateStars(selectedIndex) {
        $ratingStars.each(function (index) {
            if (index <= selectedIndex) {
                $(this).removeClass("far").addClass("fas text-yellow-400");
            } else {
                $(this).addClass("far").removeClass("fas text-yellow-400");
            }
        });
    }

    // إرسال التقييم باستخدام jQuery AJAX
    $("#reviewForm").on("submit", function (e) {
        e.preventDefault();

        const $form = $(this);
        const $submitButton = $form.find("button[type='submit']");

        // تعطيل زر الإرسال وإظهار حالة التحميل
        $submitButton
            .prop("disabled", true)
            .html(
                '<i class="fas fa-spinner fa-spin mr-2"></i> جاري الإرسال...'
            );

        $.ajax({
            url: $form.attr("action"),
            type: "POST",
            data: $form.serialize(),
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.success) {
                    // إضافة التقييم الجديد للصفحة
                    $(".reviews-container").prepend(
                        createReviewHTML(response.review)
                    );

                    // إعادة تعيين النموذج
                    $form[0].reset();
                    $ratingStars
                        .addClass("far")
                        .removeClass("fas text-yellow-400");

                    // رسالة نجاح
                    showAlert("تم إضافة تقييمك بنجاح", "success");
                }
            },
            error: function (xhr) {
                const errorMessage =
                    xhr.responseJSON?.message || "حدث خطأ أثناء إرسال التقييم";
                showAlert(errorMessage, "error");
            },
            complete: function () {
                // إعادة تفعيل زر الإرسال
                $submitButton.prop("disabled", false).html("إرسال التقييم");
            },
        });
    });

    function createReviewHTML(review) {
        return `
            <div class="review-card hover:shadow-lg transition-shadow duration-300">
                <div class="review-header">
                    <div class="reviewer-info">
                        <img src="https://ui-avatars.com/api/?name=${encodeURIComponent(review.user.name)}&size=40"
                            alt="${review.user.name}" class="w-10 h-10 rounded-full inline-block">
                        <div class="ml-3 inline-block">
                            <span class="review-author font-semibold text-gray-800">${review.user.name}</span>
                            <div class="text-sm text-gray-500">للتو</div>
                        </div>
                    </div>
                    <div class="review-rating">
                        ${createStarRating(review.rating)}
                    </div>
                </div>
                <div class="review-content mt-3">
                    <p class="text-gray-700">${review.content}</p>
                </div>
            </div>
        `;
    }

    function createStarRating(rating) {
        let starsHtml = '';
        for (let i = 1; i <= 5; i++) {
            starsHtml += `<i class="${i <= rating ? 'fas' : 'far'} fa-star ${i <= rating ? 'text-yellow-400' : 'text-gray-300'}"></i>`;
        }
        return starsHtml;
    }

    function showAlert(message, type) {
        const alertHtml = `
            <div class="fixed top-4 right-4 px-6 py-3 rounded-lg ${
                type === "success" ? "bg-green-500" : "bg-red-500"
            } text-white shadow-lg z-50 animate-fade-in-down">
                <div class="flex items-center space-x-2">
                    <i class="fas ${
                        type === "success"
                            ? "fa-check-circle"
                            : "fa-exclamation-circle"
                    }"></i>
                    <span>${message}</span>
                </div>
            </div>
        `;

        const $alert = $(alertHtml).appendTo("body");
        setTimeout(() => {
            $alert.fadeOut(300, function () {
                $(this).remove();
            });
        }, 3000);
    }
});


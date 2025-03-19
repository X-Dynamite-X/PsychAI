import $ from 'jquery';

$(document).ready(function() {
    const $commentForm = $('.comment-form');
    const $commentsList = $('.comments-list');
    const $commentInput = $('textarea[name="commant"]');
    const $submitButton = $('.comment-submit');

    // تعديل حجم textarea تلقائ<|im_start|>
    $commentInput.on('input', function() {
        const maxHeight = 300;
        $(this).css('height', 'auto');
        $(this).css('height', Math.min(this.scrollHeight, maxHeight) + 'px');
    });

    // معالجة إرسال التعليق
    $commentForm.on('submit', function(e) {
        e.preventDefault();

        const videoId = window.location.pathname.split('/').pop();
        const comment = $commentInput.val().trim();

        if (!comment) return;

        // تغيير حالة الزر إلى جاري الإرسال
        $submitButton
            .prop('disabled', true)
            .html('<i class="fas fa-spinner fa-spin ml-2"></i> جاري الإرسال...');

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: {
                commant: comment,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                // إضافة التعليق الجديد
                const newComment = `
                    <div class="comment-card" style="opacity: 0">
                        <div class="comment-header">
                            <span class="comment-author">${response.commant.user.name}</span>
                            <span class="comment-date">الآن</span>
                        </div>
                        <p class="comment-content">${response.commant.commant}</p>
                    </div>
                `;

                // إزالة رسالة "لا توجد تعليقات"
                if ($commentsList.find('.text-gray-500').length) {
                    $commentsList.empty();
                }

                // إضافة التعليق مع تأثير حركي
                const $newComment = $(newComment).prependTo($commentsList);
                $newComment.animate({ opacity: 1 }, 500);

                // إعادة تعيين النموذج
                $commentInput.val('').css('height', 'auto');
                showAlert('تم إضافة تعليقك بنجاح', 'success');
            },
            error: function(xhr) {
                showAlert('حدث خطأ أثناء إضافة التعليق', 'error');
            },
            complete: function() {
                // إعادة تفعيل زر الإرسال
                $submitButton
                    .prop('disabled', false)
                    .html('إرسال التعليق');
            }
        });
    });

    // دالة لعرض التنبيهات
    function showAlert(message, type) {
        const alertHtml = `
            <div class="alert alert-${type}" style="display: none">
                <p>${message}</p>
            </div>
        `;

        const $alert = $(alertHtml).insertBefore($commentForm);
        $alert
            .slideDown()
            .delay(3000)
            .slideUp(function() {
                $(this).remove();
            });
    }

    // معالجة الفيديوهات ذات الصلة
    $('.related-video').on('click', function(e) {
        e.preventDefault();
        const videoUrl = $(this).data('video-url');
        const videoTitle = $(this).data('video-title');

        // تحديث عنوان الفيديو
        $('.video-header h1').text(videoTitle);

        // تحديث iframe الفيديو مع تأثير تلاشي
        const $videoFrame = $('.video-frame iframe');
        $videoFrame.fadeOut(300, function() {
            $(this).attr('src', videoUrl).fadeIn(300);
        });

        // تحديث URL الصفحة بدون إعادة تحميل
        window.history.pushState({}, '', $(this).attr('href'));
    });

    // تفعيل زر العودة للأعلى عند التمرير
    const $backToTop = $('<button>', {
        class: 'back-to-top',
        html: '<i class="fas fa-arrow-up"></i>'
    }).appendTo('body');

    $(window).on('scroll', function() {
        if ($(this).scrollTop() > 300) {
            $backToTop.fadeIn();
        } else {
            $backToTop.fadeOut();
        }
    });

    $backToTop.on('click', function() {
        $('html, body').animate({ scrollTop: 0 }, 600);
    });

    // إضافة أنماط CSS للزر
    $('<style>')
        .text(`
            .back-to-top {
                position: fixed;
                bottom: 20px;
                right: 20px;
                background-color: #81AD74;
                color: white;
                width: 40px;
                height: 40px;
                border-radius: 50%;
                display: none;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                border: none;
                box-shadow: 0 2px 5px rgba(0,0,0,0.2);
                transition: all 0.3s ease;
            }
            .back-to-top:hover {
                background-color: #6a8f63;
                transform: translateY(-2px);
            }
            .alert {
                padding: 1rem;
                border-radius: 8px;
                margin-bottom: 1rem;
            }
            .alert-success {
                background-color: #E8F5E9;
                color: #2E7D32;
                border: 1px solid #81C784;
            }
            .alert-error {
                background-color: #FFEBEE;
                color: #C62828;
                border: 1px solid #EF5350;
            }
        `)
        .appendTo('head');
});


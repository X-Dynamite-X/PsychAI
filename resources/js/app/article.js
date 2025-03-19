import $ from 'jquery';

$(document).ready(function() {
    const $commentForm = $('.comment-form');
    const $commentsList = $('.comments-list');
    const $commentInput = $('textarea[name="commant"]');
    const $submitButton = $('.submit-button');

    // تعديل حجم textarea تلقائ<|im_start|>
    $commentInput.on('input', function() {
        const maxHeight = 300;
        $(this).css('height', 'auto');
        $(this).css('height', Math.min(this.scrollHeight, maxHeight) + 'px');
    });

    // معالجة إرسال التعليق
    $commentForm.on('submit', function(e) {
        e.preventDefault();

        const articleId = window.location.pathname.split('/').pop();
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
                        <div class="comment-content">
                            ${response.commant.commant}
                        </div>
                    </div>
                `;

                // إزالة رسالة "لا توجد تعليقات"
                if ($commentsList.find('.text-gray-600').length) {
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

    // تفعيل زر حذف المقال
    $('.delete-article').on('click', function(e) {
        e.preventDefault();
        if (confirm('هل أنت متأكد من حذف هذا المقال؟')) {
            const articleId = $(this).data('article-id');
            $.ajax({
                url: `/articles/${articleId}`,
                type: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function() {
                    window.location.href = '/articles';
                },
                error: function() {
                    showAlert('حدث خطأ أثناء حذف المقال', 'error');
                }
            });
        }
    });

    // تفعيل مشاركة المقال
    $('.share-article').on('click', function(e) {
        e.preventDefault();
        const url = window.location.href;
        const title = $('.article-title').text();

        if (navigator.share) {
            navigator.share({
                title: title,
                url: url
            }).catch(console.error);
        } else {
            // نسخ الرابط إلى الحافظة
            navigator.clipboard.writeText(url).then(function() {
                showAlert('تم نسخ رابط المقال', 'success');
            });
        }
    });

    // إضافة أنماط CSS للتنبيهات
    $('<style>')
        .text(`
            .alert {
                padding: 1rem;
                border-radius: 8px;
                margin-bottom: 1rem;
                text-align: center;
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
            .comment-card {
                transition: opacity 0.5s ease;
            }
        `)
        .appendTo('head');
});

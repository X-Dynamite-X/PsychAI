import $ from "jquery";
$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});
let currentDeleteId = null;

window.showLoading = function () {
    $("#loadingIndicator").removeClass("hidden");
};

window.hideLoading = function () {
    $("#loadingIndicator").addClass("hidden");
};

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    let searchTimer;

    $("#searchInput").on("input", function () {
        clearTimeout(searchTimer);
        searchTimer = setTimeout(() => fetchUsers(), 300);
    });

    // إضافة مستمعي الأحداث لروابط الصفحات عند تحميل الصفحة
    $("#pagination a").on("click", function (e) {
        e.preventDefault();
        fetchUsers($(this).attr("href"));
    });
});

window.fetchUsers = function (page = null) {
    const searchTerm = $("#searchInput").val();
    let url = "/admin/users";

    if (page) {
        url = page;
    }
    // showLoading();

    $.ajax({
        url: url,
        type: "GET",
        data: {
            search: searchTerm,
        },
        success: function (response) {
            $("#usersTableBody").html(response.html);
            $("#pagination").html(response.pagination);
            $("#pagination a").on("click", function (e) {
                e.preventDefault();
                fetchUsers($(this).attr("href"));
            });
        },
        error: function (xhr, status, error) {
            showAlert("Error loading users", "error");
        },
        complete: function () {
            hideLoading();
        },
    });
};

window.showAlert = function (message, type = "success") {
    const alertDiv = $(`
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
    `);

    $("body").append(alertDiv);
    setTimeout(() => {
        alertDiv.fadeOut(300, function () {
            $(this).remove();
        });
    }, 3000);
};

window.openEditModal = function (user) {
    const row = $(`tr[data-user-id="${user.id}"]`);
    const name = row.find(".user-name").text();
    const email = row.find(".user-email").text();
    const role = row.find(".user-role").text().toLowerCase();

    // تعيين قيم الحقول
    $("#editUserId").val(user.id);
    $("#editName").val(name.trim());
    $("#editEmail").val(email.trim());
    $("#editRole").val(role.trim().toLowerCase());

     resetEditUserErrors();


    $("#editModal").removeClass("hidden").addClass("animate-fade-in");
};

window.closeModal = function () {
    $(".deleteModal, .editModal")
        .addClass("hidden")
        .removeClass("animate-fade-in");
};

// دالة لعرض أخطاء التعديل
window.displayEditUserErrors = function (errors) {
    const errorContainer = $("#editUserErrors");
    const errorList = errorContainer.find("ul");
    errorList.empty();

    // إعادة تعيين الأخطاء السابقة
    $("#editForm .error-message").addClass("hidden").text("");
    $("#editForm input").removeClass("border-red-500");

    if (typeof errors === "object") {
        Object.keys(errors).forEach((field) => {
            const errorMessages = Array.isArray(errors[field])
                ? errors[field]
                : [errors[field]];

            errorMessages.forEach((errorMsg) => {
                // تحسين عرض اسم الحقل
                const fieldName = field
                    .split("_")
                    .map((word) => word.charAt(0).toUpperCase() + word.slice(1))
                    .join(" ");

                // إضافة رسالة الخطأ إلى القائمة
                errorList.append(`
                            <li class="flex items-center">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                <span class="font-semibold">${fieldName}:</span> ${errorMsg}
                            </li>
                        `);

                // إظهار الخطأ تحت الحقل المعني
                const errorSpan = $(
                    `#editForm .error-message[data-for="${field}"]`
                );
                if (errorSpan.length) {
                    errorSpan.removeClass("hidden").text(errorMsg);
                    $(
                        `#edit${field.charAt(0).toUpperCase() + field.slice(1)}`
                    ).addClass("border-red-500");
                }
            });
        });

        errorContainer.removeClass("hidden");
    }
};

// دالة لإعادة تعيين أخطاء التعديل
window.resetEditUserErrors = function () {
    $("#editUserErrors").addClass("hidden").find("ul").empty();
    $("#editForm .error-message").addClass("hidden").text("");
    $("#editForm input").removeClass("border-red-500");
};

$("#editForm").on("submit", function (e) {
    e.preventDefault(); // منع إعادة تحميل الصفحة

    const userId = $("#editUserId").val();
    const submitBtn = $(this).find('button[type="submit"]'); // زر الإرسال
    const originalContent = submitBtn.html(); // حفظ النص الأصلي للزر
    console.log(userId);
    const url = `/users/${userId}`;
    console.log(url);

    // تعطيل الزر وإظهار مؤشر التحميل
    submitBtn
        .html('<i class="fas fa-spinner fa-spin mr-2"></i>Saving...')
        .prop("disabled", true);

    // إرسال البيانات عبر AJAX
    $.ajax({
        url: url, // الرابط المستهدف
        type: "PUT", // نوع الطلب (PUT للتحديث)
        data: {
            name: $("#editName").val(), // اسم المستخدم
            email: $("#editEmail").val(), // البريد الإلكتروني
            role: $("#editRole").val(), // الدور
            _token: $('meta[name="csrf-token"]').attr("content"), // رمز CSRF
        },
        success: function (response) {
            if (response.success) {
                // تحديث الصف في الجدول دون إعادة تحميل الصفحة
                const row = $(`tr[data-user-id="${userId}"]`);
                row.find(".user-name").text(response.user.name); // تحديث الاسم
                row.find(".user-email").text(response.user.email); // تحديث البريد
                row.find(".user-status span").html(`
                    <i class="fas fa-check-circle mr-1"></i>
                    ${response.user.roles[0].name}
                `);

                // إغلاق المودال وإظهار رسالة النجاح
                window.closeModal();
                showAlert("User updated successfully", "success");
            }
        },
        error: function (xhr) {
            // معالجة الأخطاء
            const response = xhr.responseJSON;
            displayEditUserErrors(
                response.errors || { error: [response.message] }
            );
        },
        complete: function () {
            // إعادة تعيين الزر إلى حالته الأصلية
            submitBtn.html(originalContent).prop("disabled", false);
        },
    });
});

window.openDeleteModal = function (userId) {
    currentDeleteId = userId;
    const row = $(`tr[data-user-id="${userId}"]`);
    const userName = row.find(".user-name").text();

    // تعيين اسم المستخدم في المودال
    $("#deleteUserName").text(userName);

    // إظهار المودال
    $("#deleteModal").removeClass("hidden").addClass("animate-fade-in");
};

window.confirmDelete = function () {
    if (currentDeleteId) {
        $.ajax({
            url: `/users/${currentDeleteId}`,
            type: "DELETE",
            success: function (response) {
                if (response.success) {
                    // حذف الصف من الجدول
                    $(`tr[data-user-id="${currentDeleteId}"]`).remove();

                    closeModal();
                    showAlert("User deleted successfully", "success");
                }
            },
            error: function (xhr) {
                if (xhr.status === 419) {
                    // CSRF token mismatch
                    showAlert(
                        "Session expired. Please refresh the page.",
                        "error"
                    );
                } else {
                    showAlert("Error deleting user", "error");
                }
            },
            complete: function () {
                closeModal();
            },
        });
    }
};
